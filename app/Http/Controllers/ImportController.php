<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadType;
use DateTime;
use Illuminate\Http\Request;

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
        $lead = Lead::find($request->id);
        dd($lead);
    }
}
