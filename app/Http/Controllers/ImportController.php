<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadType;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

class ImportController extends Controller
{
    private $moduleName = "Import CSV";
    private $view = "import";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::get();
        return view("$this->view/index",compact('moduleName','leadTypes'));
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

            $lead = Lead::create([
                'lead_type_id' => $request->lead_type_id,
                'file_name' => $title,
                'uploaded_datetime' => date(now()),
                'status' => 0,
                'added_by' => auth()->user()->id,
            ]);

            return [true,'id' => $lead->id];
        }
    }

    public function start_upload(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $lead = Lead::find($request->id);
        $fileName = $lead->file_name . "_" . strtotime($lead->uploaded_datetime). ".csv";

        $url = storage_path("app/import/$fileName");
		$excelReader = PHPExcel_IOFactory::createReaderForFile($url);
		$excelObj = $excelReader->load($url);
		$worksheet = $excelObj->getActiveSheet();
		$lastRow = $worksheet->getHighestRow();

        return $lastRow;
    }
}
