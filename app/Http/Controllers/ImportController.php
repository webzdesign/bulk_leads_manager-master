<?php

namespace App\Http\Controllers;

use App\Exports\ExportCSV;
use App\Exports\ImportDownload;
use App\Imports\GetData;
use App\Imports\LeadImport;
use App\Models\AgeGroup;
use App\Models\City;
use App\Models\Country;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadFields;
use App\Models\LeadType;
use App\Models\SiteSetting;
use App\Models\State;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    private $moduleName = "Import CSV";
    private $view = "import";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::get();
        $leadFields = LeadFields::get();
        return view("$this->view/index",compact('moduleName','leadTypes','leadFields'));
    }

    public function importCSV(Request $request)
    {
        ini_set('upload_max_filesize','200M');
        $validate = $request->validate([
            'lead_type_id' => 'required',
            'file' => 'required'
        ]);

        if($request->lead_type_id != '' && $request->file != '')
        {
            if($request->has('file')) {
                $file = $request->file('file');

                if( $file->getClientOriginalExtension() != 'csv') {
                    $error = ('Invalid File Format , Please select .csv');
                    return ['error',$error];
                }

                if($request->title != null) {
                    $title = $request->title;
                } else {
                    $name = explode('.'.$file->getClientOriginalExtension(), $file->getClientOriginalName());
                    $title = $name[0];
                }

                $fileName = $title ."_". strtotime(date(now())) ."." . $file->getClientOriginalExtension();
                $file->move('storage/app/import', $fileName);
            }

            $leadData = Lead::create([
                'lead_type_id' => $request->lead_type_id,
                'file_name' => $fileName,
                'uploaded_datetime' => date(now()),
                'status' => 0,
                'added_by' => auth()->user()->id,
            ]);

            $lead = Lead::with(['user','lead_type'])->find($leadData->id);
            $date = explode(" ",$lead->uploaded_datetime);

            return [true, 'uploaded_date' => $date[0], 'uploaded_by' => $lead->user->firstName, 'file_name' => $lead->file_name ,'lead_type' => $lead->lead_type->name, 'leadId' => $leadData->id ,'file_in_db'=>$fileName];
        }
    }

    public function getData(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $lead = Lead::find($request->id);
        $fileName = $lead->file_name;
        $lead_older = SiteSetting::find(1);
        $days = $lead_older->disallow_import_lead_older * 30;

        $getData = Excel::toArray(new GetData,storage_path('app/import/'.$fileName));

        $values = array();
        foreach($getData[0] as $key => $row) {
            if($key == 0) {
                continue;
            }
            if($key == 16) {
                break;
            }
            $values[] = $row;
        }
        // $col = (count($values[0]));
        return json_encode(['values' => $values, 'days' => $days]);
    }

    public function start_upload(Request $request)
    {
        ini_set('memory_limit', -1);
        ini_set('MAX_EXECUTION_TIME', 0);

        // DB::beginTransaction();

        $getData = (new FastExcel)->import(storage_path('app/import/'.$request->filename));
        $getData = $getData->toArray();
        $rows = array_map(function($element){
            return array_values($element);
        }, $getData);

        $totalRows = count($rows);
        $duplicateRecords = 0;
        $invalid = 0;

        $leadFields = LeadFields::where('status', 1)->pluck('id', 'columnName')->toArray();
        $lead_older = SiteSetting::find(1);
        $days = $lead_older->disallow_import_lead_older * 30;

        $email_index = array_search($leadFields['email'], $request->id) ? array_search($leadFields['email'],$request->id) : null;
        $gender_index = array_search($leadFields['gender'] ,$request->id) ? array_search($leadFields['gender'], $request->id) : null;
        $city_index = array_search($leadFields['city_id'] ,$request->id) ? array_search($leadFields['city_id'], $request->id) : null;
        $state_index = array_search($leadFields['state_id'] ,$request->id) ? array_search($leadFields['state_id'], $request->id) : null;
        $country_index = array_search($leadFields['country_id'] ,$request->id) ? array_search($leadFields['country_id'] ,$request->id) : null;
        $dob_index = array_search($leadFields['birth_date'] ,$request->id) ? array_search($leadFields['birth_date'] ,$request->id) : null;
        $date_generated_index = array_search($leadFields['date_generated'],$request->id) ? array_search($leadFields['date_generated'],$request->id) : null;
        $ip_index = array_search($leadFields['ip'],$request->id) ? array_search($leadFields['ip'],$request->id) : null;
        $phone_number_index = array_search($leadFields['phone_number'],$request->id) ? array_search($leadFields['phone_number'],$request->id) : null;

        $emails = LeadDetail::where('is_duplicate', 0)->where('is_invalid', 0)->pluck('email')->toArray();
        $countries = Country::pluck('id', 'name')->toArray();
        $states = State::pluck('id', 'name')->toArray();
        $cities = City::pluck('id', 'name')->toArray();
        $lead = Lead::find($request->leadId);

        $columns = array_filter($request->id, fn($value) => !is_null($value) && $value !== 'null');
        foreach($columns as $key => $column) {
            $columnName[$key] = LeadFields::where('id',$column)->first()->columnName;
        }

        $mainArr = array();
        $rejected = 0;

        foreach ($rows as $row) {
            $allEmpty = 0;
            $totalRow = 0;
            foreach ($row as $checkRow) {
                if (trim($checkRow) == '' || trim($checkRow) == null) {
                    $allEmpty++;
                }
                $totalRow++;
            }
            if ($totalRow == $allEmpty) { continue; }

            $row = array_map("utf8_encode", $row);
            $arr = [];

            if ($gender_index) {
                if( strtolower($row[$gender_index]) == 'm' || strtolower($row[$gender_index]) == 'male') {
                    $row[$gender_index] = 1;
                } else if(strtolower($row[$gender_index]) == 'f' || strtolower($row[$gender_index]) == 'female') {
                    $row[$gender_index] = 0 ;
                } else {
                    $row[$gender_index] = 1;
                }
            }

            if ($email_index) {

                if ($row[$email_index] != '' || $row[$email_index] != null) {
                    if (in_array($row[$email_index], $emails)) {
                        $arr['is_duplicate'] = 1;
                        $arr['is_invalid'] = 0;
                        $duplicateRecords++;
                    } else {
                        $arr['is_duplicate'] = 0;
                        $arr['is_invalid'] = 0;
                        $emails[] = $row[$email_index];
                    }
                } else {
                    $arr['is_duplicate'] = 0;
                    $arr['is_invalid'] = 1;
                    $invalid++;
                    continue;
                }
            }

            if($phone_number_index) {
                if($row[$phone_number_index] != '' || $row[$phone_number_index] != null) {
                    $arr['phone_number'] = $row[$phone_number_index];
                } else {
                    $invalid++;
                    continue;
                }
            }

            if ($country_index) {
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

            if ($state_index) {
                if ($row[$state_index] != '' && $row[$state_index] != null) {
                    if (isset($states[$row[$state_index]])) {
                        $row[$state_index] = $states[$row[$state_index]];
                    } else {
                        $stateCountry = null;
                        if ($country_index) {
                            $stateCountry = $row[$country_index];
                        }
                        $newState = State::create(['name' => $row[$state_index], 'country_id'=> $stateCountry]);
                        $states[$row[$state_index]] = $newState->id;
                        $row[$state_index] = $newState->id;
                    }
                }
            }

            if ($city_index) {
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

            if ($dob_index) {
                $row[$dob_index] = date('Y-m-d', strtotime($row[$dob_index]));
            }

            if($ip_index) {
                $arr['ip'] = $row[$ip_index];
            }

            $arr['lead_id'] = $lead->id;
            $arr['created_at'] = date('Y-m-d H:i:s');

            if ($date_generated_index) {
                if (strpos($row[$date_generated_index], '-') !== false) {
                    $checkDate = explode('-',$row[$date_generated_index]);
                    if(isset($checkDate[0]) && isset($checkDate[1]) && isset($checkDate[2])) {

                        if(strlen($checkDate[0]) == '2' && strlen($checkDate[1]) == '2' ) {
                            if(strlen($checkDate[2]) == '2') {
                                $dates = DateTime::createFromFormat('y', $checkDate[2]);
                                $year = $dates->format('Y');

                                $generated_date = date("Y-m-d",strtotime($checkDate[1].'-'.$checkDate[0].'-'.$year));
                            } else {
                                $generated_date = date("Y-m-d",strtotime($checkDate[1].'-'.$checkDate[0].'-'.$checkDate[2]));
                            }
                        }
                    }

                } else {
                    $checkDate = explode('/',$row[$date_generated_index]);
                    if(isset($checkDate[0]) && isset($checkDate[1]) && isset($checkDate[2])) {

                        if(strlen($checkDate[0]) == '2' && strlen($checkDate[1]) == '2' ) {
                            if(strlen($checkDate[2]) == '2') {
                                $dates = DateTime::createFromFormat('y', $checkDate[2]);
                                $year = $dates->format('Y');

                                $generated_date = date("Y-m-d",strtotime($checkDate[1].'-'.$checkDate[0].'-'.$year));
                            } else {
                                $generated_date = date("Y-m-d",strtotime($checkDate[1].'-'.$checkDate[0].'-'.$checkDate[2]));
                            }
                        }
                    }
                }

                $today = date('Y-m-d');
                $date1 = date_create($generated_date);
                $date2 = date_create($today);
                $diff  = date_diff($date1,$date2);
                $diffDays = intval($diff->format("%a"));

                if($diffDays > $days) {
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

            foreach($columnName as $key => $column) {
                if ($row[$key] == '' || strlen($row[$key]) == 0) {
                    $arr[$column] = NULL;
                } else {
                    $arr[$column] = utf8_encode($row[$key]);
                }
            }

            if (!empty($arr)) {
                $mainArr[] = $arr;
            }
            if (count($mainArr) == 2000) {
                LeadDetail::query()->insert($mainArr);
                $mainArr = [];
            }
        }

        if (count($mainArr) > 0) {
            LeadDetail::query()->insert($mainArr);
        }

        $imported = ( $totalRows - ($duplicateRecords+$invalid) ) - $rejected;

        if ($rows) {
            Lead::find($lead->id)->update(['rows' => $totalRows, 'duplicate_row' => $duplicateRecords, 'invalid_row' => $invalid, 'total_row' => $imported, 'status' => 3]);

            // DB::commit();

            $file = Lead::where('id',$lead->id)->first()->file_name;
            $uploadedTime = \Carbon\Carbon::createFromDate(Lead::where('id',$lead->id)->first()->uploaded_datetime);
            $from = \Carbon\Carbon::now();

            $uploadTime = $file . " (Uploaded " . $uploadedTime->diffInHours($from) .' hours and '. $uploadedTime->diffInMinutes($from).' minutes ago.)';
            return response()->json(['message'=>'Data Inserted successFully','duplicate'=>$duplicateRecords,'invalid' => $invalid ,'import'=>$imported,'rows'=>$totalRows ,'done'=>true ,'lead'=>$lead->id , 'uploadTime'=>$uploadTime, 'rejected' => $rejected]);

        } else {
            return response()->json(['message'=>'No Data Found In File','done'=>false]);
        }

    }

    public function downloadCsv(Request $request)
    {
        ini_set('memory_limit', -1);
        ini_set('MAX_EXECUTION_TIME', 0);

        return Excel::download(new ExportCSV($request->lead_id,$request->type),"test.csv");
    }
}
