<?php

namespace App\Http\Controllers;

use App\Exports\LeadStatusDownload;
use App\Models\AgeGroup;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use App\Models\State;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ImportHistoryController extends Controller
{
    private $moduleName = "Import History";
    private $view = "importHistory";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::get();

        return view("$this->view/index", compact('moduleName', 'leadTypes'));
    }

    public function getData(Request $request)
    {
        $lead = Lead::with('lead_type')->select('leads.*');

        if ($request->leadType) {
            $lead->where('lead_type_id', $request->leadType);
        }

       return DataTables::eloquent($lead)
       ->editColumn('file_name',function($row){
            $path = url('storage/app/import/' . $row->file_name);
            return '<a href="'.$path.'" class="c-16 text-underline" download>'.$row->file_name.'</a>';
       })
       ->editColumn('ageGroup',function($row){
            $ageGroup = '';
            $agegroupIds = LeadDetail::where('lead_id', $row->id)->groupBy('age_group_id')->pluck('age_group_id')->toArray();
            $agegroups = AgeGroup::whereIn('id', $agegroupIds)->get();

            if ($agegroups) {
                foreach ($agegroups as $age) {
                    $ageGroup .= $age->age_from.'-'.$age->age_to.' Days Old <br/>';
                }
            } else {
                $ageGroup .= 'Not specified';
            }

            return $ageGroup;
       })
       ->editColumn('total_row',function($row){
            return $row->total_row . ' Leads';
       })
       ->editColumn('duplicate_row',function($row){
            $downloadUrl = route('admin.import-history.downloadDuplicate', encrypt($row->id));
            if( $row->duplicate_row == 0)
                return  $row->duplicate_row;
            else
                return $row->duplicate_row .'<a href="'.$downloadUrl.'" class="c-4b"> Download</a>';
       })
       ->editColumn('status',function($row){
            $downloadUrl =route('admin.import-history.downloadOriginal', encrypt($row->id));
            if ($row->status == 3)
                return '<a href="'.$downloadUrl.'" class="c-4b">Successfully imported - Download</a>';
            elseif ($row->status == 0)
                return 'Pending';
            elseif ($row->status == 1)
                return 'Processing';
            elseif ($row->status == 2)
                return 'error';
       })
       ->editColumn('uploaded_datetime',function($row){
         return date('d/m/Y', strtotime($row->uploaded_datetime))." At ".date('H:i A', strtotime($row->uploaded_datetime));
      })
       ->rawColumns(['lead_type_id','ageGroup','file_name','status','uploaded_datetime','duplicate_row'])
        ->make(true);

    }

    public function getAge(Request $request)
    {
        if($request->type)
        {
            $lead = LeadType::where('id',$request->type)->first()->name;
            $age = AgeGroup::where('lead_type_id',$request->type)->get();
        }
        return response()->json([$age,$lead]);
    }

    public function downloadOriginal($id)
    {
        $type = 'original';
        // return Excel::download(new LeadStatusDownload($id,$type), Lead::where('id',decrypt($id))->first()->file_name."-importedRecords.csv");
    }

    public function downloadDuplicate($id)
    {
        $type = 'duplicate';
        // return Excel::download(new LeadStatusDownload($id,$type), Lead::where('id',decrypt($id))->first()->file_name."-duplicateRecords.csv");
    }

}
