<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

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
        $file =$row->file_name . "_" . strtotime($row->uploaded_datetime). ".csv";
        $path =url('storage/app/import/' . $file);
        return '<a href="'.$path.'" class="c-16 text-underline" download>'.$row->file_name.'</a>';
       })
       ->editColumn('ageGroup',function($row){
        return "-";
       })
       ->editColumn('quentity',function($row){
        return $row->total_row;
       })
       ->editColumn('status',function($row){
         return '<a href="" class="c-4b">Successfully imported - Download</a>';
       })
       ->editColumn('uploaded_datetime',function($row){
         return date('d/m/Y', strtotime($row->uploaded_datetime))." At ".date('H:i A', strtotime($row->uploaded_datetime));
      })
       ->rawColumns(['lead_type_id','ageGroup','file_name','status','uploaded_datetime'])
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


}
