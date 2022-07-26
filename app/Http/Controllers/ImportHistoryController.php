<?php

namespace App\Http\Controllers;

use App\Exports\LeadStatusDownload;
use App\Models\AgeGroup;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\returnSelf;

class ImportHistoryController extends Controller
{
    //
    private $moduleName = "Import History";
    private $view = "importHistory";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::all();
        $genders = LeadDetail::all()->unique('gender')->pluck('gender');
        $states = LeadDetail::with('state')->get()->unique('state_id');
        $leadAge = AgeGroup::with('leadType')->get();
        return view("$this->view/index", compact('moduleName','genders','leadAge','leadTypes','states'));
    }

    public function getData(Request $request)
    {
       $lead = Lead::with('lead_type')->select('*');
       if($request->leadType)
        {
            $lead->where('lead_type_id',$request->leadType)->select('*');
        }
        $data = $lead;
       return DataTables::eloquent($data)
       ->editColumn('lead_type_id',function($row){
        return $row->lead_type->name;
       })
       ->editColumn('file_name',function($row){
        $file =$row->file_name;
        $path =url('storage/app/import/' . $file);
        return '<a href="'.$path.'" class="c-16 text-underline" download>'.$row->file_name.'</a>';
       })
       ->editColumn('ageGroup',function($row){
            $data = '';
                $agegroups = LeadDetail::where('lead_id',$row->id)->pluck('age_group_id')->unique('age_group_id');
                if($agegroups)
                {
                    foreach($agegroups as $ag)
                    {
                        $age = AgeGroup::where('id',$ag)->first();
                        if($age)
                        {
                            $data .= $age->age_from.'-'.$age->age_to.' Days Old <br/>';
                        }

                    }
                }
                else
                {
                    $data = 'Not specified';
                }
                return $data;
       })
       ->editColumn('quentity',function($row){
        return $row->total_row . ' Leads';
       })
       ->editColumn('duplicate_row',function($row){

         $downloadUrl =route('admin.import-history.downloadDuplicate', encrypt($row->id));
         if( $row->duplicate_row == 0)
            return  $row->duplicate_row;
        else
         return $row->duplicate_row .'<a href="'.$downloadUrl.'" class="c-4b"> Download</a>';

        // return $row->duplicate_row.' download';
       })
       ->editColumn('status',function($row){
        $downloadUrl =route('admin.import-history.downloadOriginal', encrypt($row->id));
        if($row->status == 3)
         return '<a href="'.$downloadUrl.'" class="c-4b">Successfully imported - Download</a>';
        elseif($row->status == 0)
            return 'Pending';
        elseif($row->status == 1)
            return 'Processing';
        elseif($row->status == 2)
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
        return Excel::download(new LeadStatusDownload($id,$type), Lead::where('id',decrypt($id))->first()->file_name."-importedRecords.csv");
    }

    public function downloadDuplicate($id)
    {
        $type = 'duplicate';
        return Excel::download(new LeadStatusDownload($id,$type), Lead::where('id',decrypt($id))->first()->file_name."-duplicateRecords.csv");
    }

}
