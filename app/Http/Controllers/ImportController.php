<?php

namespace App\Http\Controllers;

use App\Exports\ImportDownload;
use App\Imports\GetData;
use App\Imports\LeadImport;
use App\Models\City;
use App\Models\Country;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadFields;
use App\Models\LeadType;
use App\Models\State;
use DateTime;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Maatwebsite\Excel\Fakes\ExcelFake;

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
                'file_name' => $title,
                'uploaded_datetime' => date(now()),
                'status' => 0,
                'added_by' => auth()->user()->id,
            ]);

            $lead = Lead::with(['user','lead_type'])->find($leadData->id);
            $date = explode(" ",$lead->uploaded_datetime);

            return [true, 'uploaded_date' => $date[0], 'uploaded_by' => $lead->user->firstName, 'file_name' => $lead->file_name ,'lead_type' => $lead->lead_type->name, 'lead_type_id' => $leadData->id ,'file_in_db'=>$fileName];
        }
    }

    public function getData(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $lead = Lead::find($request->id);
        $fileName = $lead->file_name . "_" . strtotime($lead->uploaded_datetime). ".csv";

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

        return json_encode($values);
    }

    public function start_upload(Request $request)
    {

        $rows = FacadesExcel::toArray(new LeadImport,storage_path('app/import/' . $request->filename));
        $totalRows = count($rows[0]);

        $duplicateRecords = 0;

        $email_id = LeadFields::where('columnName','email')->pluck('id');
        $email_index = array_search($email_id[0],$request->id);

        $gender_id = LeadFields::where('columnName','gender')->pluck('id');
        $gender_index = array_search($gender_id[0],$request->id);

        $city_id = LeadFields::where('columnName','city_id')->pluck('id');
        $city_index = array_search($city_id[0],$request->id);

        $state_id = LeadFields::where('columnName','state_id')->pluck('id');
        $state_index = array_search($state_id[0],$request->id);

        $country_id = LeadFields::where('columnName','country_id')->pluck('id');
        $country_index = array_search($country_id[0],$request->id);

        $dob_id = LeadFields::where('columnName','birth_date')->pluck('id');
        $dob_index = array_search($dob_id[0],$request->id);


        $invalid = 0;
        $repeatMail = [];
        foreach($rows[0] as $data)
        {
            $emailArr[] = $data[$email_index];
        }

        $emails = LeadDetail::all()->pluck('email')->toArray();

        foreach($request->id as $column)
        {
            $columnName[] = LeadFields::where('id',$column)->first()->columnName;
        }

        $mainArr = [];
        $lead = Lead::latest()->first()->id;
        foreach($rows[0] as $row) {
            $arr = [];
           if( strtolower($row[$gender_index]) == 'm' || strtolower($row[$gender_index]) == 'male')
           {
                $row[$gender_index] = 1;
           }
           else if(strtolower($row[$gender_index]) == 'f' || strtolower($row[$gender_index]) == 'female')
           {
                $row[$gender_index] = 0 ;
           }
           else
           {
                    $row[$gender_index] = 1;
           }

           $email = LeadDetail::where('email',$row[$email_index])->where('email','!=',null)->get()->count();
           if($email)
           {
                $duplicateRecords ++;
                $repeatMail[]= $row[$email_index];
           }

            $country = Country::where('name',$row[$country_index])->first();
            if($country)
            {
                $row[$country_index] = intval($country['id']);
            }
            else
            {
                $country_data = Country::create([
                    'name'=> $row[$country_index]
                ]);
                $row[$country_index] = $country_data->id;
            }

            $state = State::where('name',$row[$state_index])->first();
            if($state)
            {
                $row[$state_index] = intval($state['id']);
                $row[$country_index] = intval($state['country_id']);
            }
            else
            {
                $data = state::create([
                    'name'=> $row[$state_index],
                    'country_id' =>  $row[$country_index],
                ]);
                $row[$state_index] = $data->id;
            }

            $city = City::where('name',$row[$city_index])->first();
            if($city)
            {
                $row[$city_index] = intval($city['id']);
                $row[$state_index] = intval($city['state_id']);
            }
            else
            {
                $data = City::create([
                    'name'=> $row[$city_index],
                    'state_id' => $row[$state_index]
                ]);
                $row[$city_index] = $data->id;
            }

            $arr = array_combine($columnName,$row);

            if( in_array($row[$email_index],$repeatMail) )
            {
                 $arr['is_duplicate'] = 1;
                 $arr['is_invalid'] = 0;
            }
            elseif($row[$email_index] == null || $row[$email_index] == '' || !$row[$email_index])
            {
                $arr['is_duplicate'] = 0;
                $arr['is_invalid'] = 1;
                $invalid++;
            }
            else
            {
                $arr['is_duplicate'] = 0;
                $arr['is_invalid'] = 0;
            }

            $age = \Carbon\Carbon::parse($row[$dob_index])->diff(\Carbon\Carbon::now())->format('%y years');

            $arr['lead_id'] = $lead;
            $arr['age'] = $age;
           array_push($mainArr,$arr);

        }

        $imported = $totalRows - ($duplicateRecords+$invalid);

        if(!empty($mainArr)){
            LeadDetail::query()->insert($mainArr); //good, just be careful of the size limit of $arr, you may need to chunk it
        }
        if($rows) {
            //redirect
            Lead::find($lead)->update([
                'rows'=>$totalRows,
                'duplicate_row'=>$duplicateRecords,
                'invalid_row'=>$invalid,
                'total_row'=>$imported,
                'updated_by'=> auth()->user()->id
            ]);

            $file = Lead::where('id',$lead)->first()->file_name;
            $uploadedTime = \Carbon\Carbon::createFromDate(Lead::where('id',$lead)->first()->uploaded_datetime);
            $from = \Carbon\Carbon::now();

            $uploadTime = $file . " (Uploaded " . $uploadedTime->diffInHours($from) .' hours and '. $uploadedTime->diffInMinutes($from).' minutes ago.)';


            return response()->json(['message'=>'Data Inserted successFully','duplicate'=>$duplicateRecords,'invalid' => $invalid ,'import'=>$imported,'rows'=>$totalRows ,'done'=>true ,'lead'=>$lead , 'uploadTime'=>$uploadTime]);
        } else {
            return response()->json(['message'=>'No Data Found In File','done'=>false]);
        }

    }

    public function downloadCsv(Request $request)
    {
        if($request->type == 'duplicate')
        {
            $data = LeadDetail::where('lead_id',$request->lead_id)->where('is_duplicate',1)->get();
        }


        if($request->type == 'import')
        {
            $data = LeadDetail::where('lead_id',$request->lead_id)->where('is_duplicate',0)->where('is_invalid',0)->get();
        }


        $users = $data;

        $headers = array(
          'Content-Type' => 'text/csv'
        );
        // I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }
         //creating the download file
        $filename =  public_path("files/download.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [
            "FirstName",
            "LastName",
            "Email",
            "Phone Number",
            "Gender",
            "Address",
            "City",
            "State",
            "Country",
            "Birth Date",
            "Age",
            "Zip"
        ]);

        //adding the data from the array
        foreach ($users as $each_user) {
            $gender = $each_user->gender;
            if($each_user->gender == 1)
            {
                $gender = 'Male';
            }
            if($each_user->gender == 0)
            {
                $gender = 'Female';
            }
            $city = City::where('id',$each_user->city_id)->first()->name;
            $state = State::where('id',$each_user->state_id)->first()->name;
            $country = Country::where('id',$each_user->country_id)->first()->name;

            // $date = new DateTime($each_user->birth_date);
            // $dob = $date->format('Y-m-d');

            fputcsv($handle, [
                $each_user->first_name,
                $each_user->last_name,
                $each_user->email,
                $each_user->phone_number,
                 $gender,
                 $each_user->address,
                 $city,
                 $state,
                 $country,
                $each_user->birth_date,
                $each_user->age,
                $each_user->zip
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, ".csv", $headers);

    }
}
