<?php

namespace App\Console\Commands;

use App\Models\AgeGroup;
use App\Models\City;
use App\Models\Country;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadFields;
use App\Models\SiteSetting;
use App\Models\State;
use App\Notifications\UploadLead;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Rap2hpoutre\FastExcel\FastExcel;

class LeadUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:lead_details {param*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload Lead File Details';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', -1);
        ini_set('MAX_EXECUTION_TIME', 0);
        set_time_limit(60000);
        // $request = json_decode($this->argument('param')[0], true);
        // Log::info('data'.$request['filename']);
        // return 0;
        $requestJsonData = $this->argument('param');
        
        if (Lead::where('status', 4)->exists()) {
            self::notifyUploadStatus(['message' => 'Upload File in Progress...', 'done' => false]);
        } else  if ($requestJsonData && array_key_exists(0, $requestJsonData)) {
            
            $request = json_decode($requestJsonData[0], true);

            if(is_array($request) && array_key_exists('id', $request) && array_key_exists('filename', $request) && array_key_exists('leadType', $request) && array_key_exists('leadId', $request) && is_array($request['id']) && !is_null($request['filename']) && !is_null($request['leadId'])) {

                Lead::find($request['leadId'])->update(['status' => 4]);
                retrying:
                Log::info('retrying', $request);

                // $emails = LeadDetail::where('is_duplicate', 0)->where('is_invalid', 0)->pluck('email')->toArray();
                $countries = Country::pluck('id', 'name')->toArray();
                $states = State::pluck('id', 'name')->toArray();
                $cities = City::pluck('id', 'name')->toArray();
                $lead = Lead::find($request['leadId']);
                
                try {
                    $phoneNumbers = LeadDetail::where('is_duplicate', 0)->where('is_invalid', 0)->pluck('phone_number')->toArray();

                    $getData = (new FastExcel)->import(storage_path('app/import/' . $request['filename']));
                    $getData = $getData->toArray();
                    $rows = array_map(function ($element) {
                        return array_values($element);
                    }, $getData);

                    $totalRows = count($rows);
                    $duplicateRecords = 0;
                    $invalid = 0;

                    $leadFields = LeadFields::where('status', 1)->pluck('id', 'columnName')->toArray();
                    $lead_older = SiteSetting::find(1);
                    $days = $lead_older->disallow_import_lead_older * 30;

                    $email_index = in_array($leadFields['email'], $request['id']) ? array_search($leadFields['email'], $request['id']) : null;
                    $gender_index = in_array($leadFields['gender'], $request['id']) ? array_search($leadFields['gender'], $request['id']) : null;
                    $city_index = in_array($leadFields['city_id'], $request['id']) ? array_search($leadFields['city_id'], $request['id']) : null;
                    $state_index = in_array($leadFields['state_id'], $request['id']) ? array_search($leadFields['state_id'], $request['id']) : null;
                    $country_index = in_array($leadFields['country_id'], $request['id']) ? array_search($leadFields['country_id'], $request['id']) : null;
                    $dob_index = in_array($leadFields['birth_date'], $request['id']) ? array_search($leadFields['birth_date'], $request['id']) : null;
                    $date_generated_index = in_array($leadFields['date_generated'], $request['id']) ? array_search($leadFields['date_generated'], $request['id']) : null;
                    $ip_index = in_array($leadFields['ip'], $request['id']) ? array_search($leadFields['ip'], $request['id']) : null;
                    $phone_number_index = in_array($leadFields['phone_number'], $request['id']) ? array_search($leadFields['phone_number'], $request['id']) : null;

                    $columns = array_filter($request['id'], fn ($value) => !is_null($value) && $value !== 'null');
                    foreach ($columns as $key => $column) {
                        $columnName[$key] = LeadFields::where('id', $column)->first()->columnName;
                    }

                    $mainArr = array();
                    $rejected = 0;

                    DB::beginTransaction();
                    Log::info('first transaction');
                    foreach ($rows as $row) {
                        $allEmpty = 0;
                        $totalRow = 0;
                        foreach ($row as $checkRow) {
                            if (trim($checkRow) == '' || trim($checkRow) == null) {
                                $allEmpty++;
                            }
                            $totalRow++;
                        }
                        if ($totalRow == $allEmpty) {
                            continue;
                        }

                        $row = array_map("utf8_encode", $row);
                        $arr = [];

                        if (!is_null($gender_index)) {
                            if (strtolower($row[$gender_index]) == 'm' || strtolower($row[$gender_index]) == 'male') {
                                $row[$gender_index] = 0;
                            } else if (strtolower($row[$gender_index]) == 'f' || strtolower($row[$gender_index]) == 'female') {
                                $row[$gender_index] = 1;
                            } else {
                                $row[$gender_index] = 1;
                            }
                        }

                        if (!is_null($email_index)) {
                            $arr['email'] = $row[$email_index];
                            // if ($row[$email_index] != '' || $row[$email_index] != null) {
                            //     if (in_array($row[$email_index], $emails)) {
                            //         $arr['is_duplicate'] = 1;
                            //         $arr['is_invalid'] = 0;
                            //         $duplicateRecords++;
                            //     } else {
                            //         $arr['is_duplicate'] = 0;
                            //         $arr['is_invalid'] = 0;
                            //         $emails[] = $row[$email_index];
                            //     }
                            // } else {
                            //     $arr['is_duplicate'] = 0;
                            //     $arr['is_invalid'] = 1;
                            //     $invalid++;
                            //     continue;
                            // }
                        }

                        if (!is_null($phone_number_index)) {
                            if ($row[$phone_number_index] != '' || $row[$phone_number_index] != null) {
                                if (in_array($row[$phone_number_index], $phoneNumbers)) {
                                    $arr['is_duplicate'] = 1;
                                    $arr['is_invalid'] = 0;
                                    $duplicateRecords++;
                                } else {
                                    $arr['is_duplicate'] = 0;
                                    $arr['is_invalid'] = 0;
                                    $phoneNumbers[] = $row[$phone_number_index];
                                }
                            } else {
                                $arr['is_duplicate'] = 0;
                                $arr['is_invalid'] = 1;
                                $invalid++;
                                continue;
                            }
                        }

                        if (!is_null($country_index)) {
                            if ($row[$country_index] != '' && $row[$country_index] != null) {
                                if (isset($countries[$row[$country_index]])) {
                                    $row[$country_index] = $countries[$row[$country_index]];
                                } else {
                                    $newCountry = Country::create(['name' => $row[$country_index]]);
                                    $countries[$row[$country_index]] = $newCountry->id;
                                    $row[$country_index] = $newCountry->id;
                                }
                            }
                        }

                        if (!is_null($state_index)) {
                            if ($row[$state_index] != '' && $row[$state_index] != null) {
                                if (isset($states[strtoupper($row[$state_index])])) {
                                    $row[$state_index] = $states[strtoupper($row[$state_index])];
                                } else {
                                    $stateCountry = null;
                                    if ($country_index) {
                                        $stateCountry = $row[$country_index];
                                    }
                                    $newState = State::create(['name' => strtoupper($row[$state_index]), 'country_id' => $stateCountry]);
                                    $states[strtoupper($row[$state_index])] = $newState->id;
                                    $row[$state_index] = $newState->id;
                                }
                            }
                        }

                        if (!is_null($city_index)) {
                            if ($row[$city_index] != '' && $row[$city_index] != null) {
                                if (isset($cities[$row[$city_index]])) {
                                    $row[$city_index] = $cities[$row[$city_index]];
                                } else {
                                    $cityState = null;
                                    if ($state_index) {
                                        $cityState = $row[$state_index];
                                    }
                                    $newCity = City::create(['name' => $row[$city_index], 'state_id'  => $cityState]);
                                    $cities[$row[$city_index]] = $newCity->id;
                                    $row[$city_index] = $newCity->id;
                                }
                            }
                        }

                        if (!is_null($dob_index)) {
                            $row[$dob_index] = date('Y-m-d', strtotime($row[$dob_index]));
                        }

                        if (!is_null($ip_index)) {
                            $arr['ip'] = $row[$ip_index];
                        }

                        $arr['lead_id'] = $lead->id;
                        $arr['created_at'] = date('Y-m-d H:i:s');

                        if (!is_null($date_generated_index)) {
                            if (strpos($row[$date_generated_index], '-') !== false) {
                                $checkDate = explode('-', $row[$date_generated_index]);
                                if (isset($checkDate[0]) && isset($checkDate[1]) && isset($checkDate[2])) {

                                    if (strlen($checkDate[0]) == '2' && strlen($checkDate[1]) == '2') {
                                        if (strlen($checkDate[2]) == '2') {
                                            $dates = DateTime::createFromFormat('y', $checkDate[2]);
                                            $year = $dates->format('Y');

                                            $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $year));
                                        } else {
                                            $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $checkDate[2]));
                                        }
                                    } else {
                                        if (strlen($checkDate[0]) == '1' && strlen($checkDate[1]) == '1') {
                                            if (strlen($checkDate[2]) == '2') {
                                                $dates = DateTime::createFromFormat('y', $checkDate[2]);
                                                $year = $dates->format('Y');

                                                $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $year));
                                            } else {
                                                $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $checkDate[2]));
                                            }
                                        }
                                    }
                                }
                            } else {
                                $checkDate = explode('/', $row[$date_generated_index]);
                                if (isset($checkDate[0]) && isset($checkDate[1]) && isset($checkDate[2])) {

                                    if (strlen($checkDate[0]) == '2' && strlen($checkDate[1]) == '2') {
                                        if (strlen($checkDate[2]) == '2') {
                                            $dates = DateTime::createFromFormat('y', $checkDate[2]);
                                            $year = $dates->format('Y');

                                            $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $year));
                                        } else {
                                            $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $checkDate[2]));
                                        }
                                    } else {
                                        if (strlen($checkDate[0]) == '1' && strlen($checkDate[1]) == '1') {
                                            if (strlen($checkDate[2]) == '2') {
                                                $dates = DateTime::createFromFormat('y', $checkDate[2]);
                                                $year = $dates->format('Y');

                                                $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $year));
                                            } else {
                                                $generated_date = date("Y-m-d", strtotime($checkDate[1] . '-' . $checkDate[0] . '-' . $checkDate[2]));
                                            }
                                        }
                                    }
                                }
                            }

                            $today = date('Y-m-d');
                            $date1 = date_create($generated_date);
                            $date2 = date_create($today);
                            $diff  = date_diff($date1, $date2);
                            $diffDays = intval($diff->format("%a"));

                            if ($diffDays > $days) {
                                $rejected++;
                                continue;
                            }

                            $ageGroup = AgeGroup::select('id')->where('lead_type_id', $lead->lead_type_id)->where('age_from', '<=', $diffDays)->where('age_to', '>=', $diffDays)->first();
                            if ($ageGroup) {
                                $arr['age_group_id'] = $ageGroup->id;
                            }

                            $arr['age'] = $diffDays;
                            $row[$date_generated_index] = $generated_date;
                        } else {
                            $arr['age'] = 0;
                        }

                        foreach ($columnName as $key => $column) {
                            if (strlen($row[$key]) == 0) {
                                $arr[$column] = NULL;
                            } else {
                                $arr[$column] = utf8_encode($row[$key]);
                            }
                        }

                        if (!empty($arr)) {
                            $mainArr[] = $arr;
                        }
                        if (count($mainArr) == 2000) {
                            Log::info('inserting 2000 Data');
                            LeadDetail::query()->insert($mainArr);
                            DB::commit();
                            $mainArr = [];
                        }
                    }

                    try {
                        Log::info('second transaction');
                        DB::beginTransaction();

                        if (count($mainArr) > 0) {
                            Log::info('inserting Data');
                            LeadDetail::query()->insert($mainArr);
                        }
    
                        $imported = ($totalRows - ($duplicateRecords + $invalid)) - $rejected;
    
                        if ($rows) {
                            Log::info('updating Data');
                            Lead::find($lead->id)->update(['rows' => $totalRows, 'duplicate_row' => $duplicateRecords, 'invalid_row' => $invalid, 'total_row' => $imported, 'status' => 3]);
    
                            $file = Lead::where('id', $lead->id)->first()->file_name;
                            $uploadedTime = \Carbon\Carbon::createFromDate(Lead::where('id', $lead->id)->first()->uploaded_datetime);
                            $from = \Carbon\Carbon::now();
    
                            $uploadTime = $file . " (Uploaded " . $uploadedTime->diffInHours($from) . ' hours and ' . $uploadedTime->diffInMinutes($from) . ' minutes ago.)';
                            self::notifyUploadStatus(['message' => 'Data Inserted successFully', 'duplicate' => $duplicateRecords, 'invalid' => $invalid, 'import' => $imported, 'rows' => $totalRows, 'done' => true, 'lead' => $lead->id, 'uploadTime' => $uploadTime, 'rejected' => $rejected], $lead->added_by);
                        } else {
                            Lead::find($lead->id)->update(['status' => 0]);
                            LeadDetail::where(['lead_id' => $lead->id])->delete();
                            self::notifyUploadStatus(['message' => 'No Data Found In File', 'done' => false], $lead->added_by);
                        }

                        DB::commit();

                    } catch (\Exception $g) {
                        DB::rollBack();
                        Lead::find($lead->id)->update(['status' => 0]);
                        LeadDetail::where(['lead_id' => $lead->id])->delete();
                        Log::info('exception Data', array('err' => $g->getMessage(), 'err_no' => $g->getCode()));
                    }
                } catch (\Exception $e) {
                    Log::info('exception Data', array('err' => $e->getMessage(), 'err_no' => $e->getCode()));
                    if ($e instanceof \Illuminate\Database\QueryException) {
                        if ($e->getCode() == 1205) {
                            goto retrying;
                        } else {
                            DB::rollBack();
                            if($lead) {
                                Lead::find($lead->id)->update(['status' => 0]);
                                LeadDetail::where(['lead_id' => $lead->id])->delete();
                            }
                            self::notifyUploadStatus($e, $lead->added_by, true);
                        }
                    } else {
                        DB::rollBack();
                        if($lead) {
                            Lead::find($lead->id)->update(['status' => 0]);
                            LeadDetail::where(['lead_id' => $lead->id])->delete();
                        }
                        self::notifyUploadStatus(['message' => 'No Data Found In File', 'done' => false, 'err' => $e->getMessage()], $lead->added_by);
                    }
                }

                
            }
        }
    }

    public static function notifyUploadStatus($msg = null, $userId = 0, $err = false, $type = 'upload_notify')
    {
        if ($userId > 0) {
            $notifyData = array(
                'data' => ($err) ? $msg->getMessage() : $msg,
                'type' => $type
            );
            \App\Models\User::find($userId)->notify(new UploadLead($notifyData));
        } else {
            if (Auth::check()) {
                $notifyData = array(
                    'data' => ($err) ? $msg->getMessage() : $msg,
                    'type' => $type
                );
                Notification::send(Auth::user(), new UploadLead($notifyData));
            }
        }
    }
}
