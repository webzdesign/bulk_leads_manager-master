<?php

namespace App\Http\Controllers;

use App\Exports\ExportCSV;
use App\Imports\GetData;
use App\Models\Lead;
use App\Models\LeadFields;
use App\Models\LeadType;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class ImportController extends Controller
{
    private $moduleName = "Import CSV";
    private $view = "import";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::get();
        $leadFields = LeadFields::get();
        return view("$this->view/index", compact('moduleName', 'leadTypes', 'leadFields'));
    }

    public function importCSV(Request $request)
    {
        ini_set('upload_max_filesize', '200M');
        $validate = $request->validate([
            'lead_type_id' => 'required',
            'file' => 'required'
        ]);

        if ($request->lead_type_id != '' && $request->file != '') {
            if ($request->has('file')) {
                $file = $request->file('file');

                if ($file->getClientOriginalExtension() != 'csv') {
                    $error = ('Invalid File Format , Please select .csv');
                    return ['error', $error];
                }

                if ($request->title != null) {
                    $title = $request->title;
                } else {
                    $name = explode('.' . $file->getClientOriginalExtension(), $file->getClientOriginalName());
                    $title = $name[0];
                }

                $fileName = $title . "_" . strtotime(date(now())) . "." . $file->getClientOriginalExtension();
                $file->move('storage/app/import', $fileName);
            }

            $leadData = Lead::create([
                'lead_type_id' => $request->lead_type_id,
                'file_name' => $fileName,
                'uploaded_datetime' => date(now()),
                'status' => 0,
                'added_by' => auth()->user()->id,
            ]);

            $lead = Lead::with(['user', 'lead_type'])->find($leadData->id);
            $date = explode(" ", $lead->uploaded_datetime);

            return [true, 'uploaded_date' => $date[0], 'uploaded_by' => $lead->user->firstName, 'file_name' => $lead->file_name, 'lead_type' => $lead->lead_type->name, 'leadId' => $leadData->id, 'file_in_db' => $fileName];
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

        $getData = Excel::toArray(new GetData, storage_path('app/import/' . $fileName));

        $values = array();
        foreach ($getData[0] as $key => $row) {
            if ($key == 0) {
                continue;
            }
            if ($key == 16) {
                break;
            }
            $values[] = $row;
        }
        // $col = (count($values[0]));
        return json_encode(['values' => $values, 'days' => $days]);
    }

    public function start_upload(Request $request)
    {
        try {

            
            if (Lead::where('status', 4)->exists()) {
                return response()->json(['message' => 'Another file is being processed', 'done' => false]);
            } else {
                self::runBackgroundProcess('upload:lead_details', json_encode($request->all()));
                Lead::where('status', 4)->update(['status' => 0]);

                $lead = Lead::find($request->leadId);
                $file = Lead::where('id',$lead->id)->first()->file_name;
                $uploadedTime = \Carbon\Carbon::createFromDate(Lead::where('id',$lead->id)->first()->uploaded_datetime);
                $from = \Carbon\Carbon::now();
                $uploadTime = $file . " (Uploaded " . $uploadedTime->diffInHours($from) .' hours and '. $uploadedTime->diffInMinutes($from).' minutes ago.)';
                
                return response()->json(['message' => 'Hold on tight. Your file is being processed', 'duplicate' => 0, 'invalid' => 0, 'import' => 0, 'rows' => 0, 'done' => true, 'lead' => $request->leadId, 'uploadTime' => $uploadTime, 'rejected' => 0]);
            }
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unable to Upload File', 'done' => false, 'err' => $e]);
        }
    }

    public static function runBackgroundProcess($command, $data)
    {
        $phpBinaryFinder = new PhpExecutableFinder();

        $phpBinaryPath = $phpBinaryFinder->find();

        $process = new Process([$phpBinaryPath, base_path('artisan'), $command, $data]); // (['php', 'artisan', 'foo:bar', 'json data'])
        $process->setoptions(['create_new_console' => true]); //Run process in background 
        $process->start();
    }

    public function downloadCsv(Request $request)
    {
        ini_set('memory_limit', -1);
        ini_set('MAX_EXECUTION_TIME', 0);

        return Excel::download(new ExportCSV($request->lead_id,$request->type),"test.csv");
    }

    public function checkFileUpload(Request $request)
    {
        $checkFileUpload = Lead::find($request->leadId);
        if($checkFileUpload) {
            if($checkFileUpload->status == 3) {
                return true;
            } else {
                return "false";
            }
        }
    }
}
