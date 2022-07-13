<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeadsController extends Controller
{
    //
    private $moduleName = "Leads";
    private $view = "leads";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::all();
        $genders = LeadDetail::all()->unique('gender')->pluck('gender');
        $states = LeadDetail::all()->unique('state')->pluck('state');
        $leadAge = AgeGroup::with('leadType')->get();
        return view("$this->view/index", compact('moduleName','leadTypes','genders','leadAge','states'));
    }

    public function getData(Request $request)
    {
        // dd($request->all());
        $leadDetail = LeadDetail::with('lead')->orderBy('id','DESC');
        if($request->leadType)
        {
            $data = [];
            $leads = $leadDetail;
           foreach($leads as $us)
           {
                if($us->lead->lead_type->id == $request->leadType)
                {
                    $data[] = $us->id;
                }
           }
           $user  = LeadDetail::whereIn('id',$data)->orderBy('id','DESC');
        }
        if($request->leadAge)
        {
            $ageGroup = AgeGroup::where('id',$request->leadAge)->first();
            $leadDetail->where('age','>=',$ageGroup->age_from)->where('age','<=',$ageGroup->age_to)->select('*');
        }
        if($request->gender)
        {
            if($request->gender == 'M')
            $leadDetail->where('gender',0);
            else if($request->gender == 'F')
            $leadDetail->where('gender',1);
        }
        if($request->state)
        {
            $leadDetail->where('state',$request->state);
        }

        $data =$leadDetail;
        $selected = explode(",",$request->selected);
        return DataTables::eloquent($data)
                ->addColumn('check', function ($row) use($selected){
                    $checked = (in_array($row->id, $selected)) ? 'checked' : '';
                    // return '<input type="checkbox" class="selected dtcheckbox" name="selected[]" '.$checked.' value="' . $row->id . '" />';
                    return '<span style="width: 50px;">
                    <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                    <input name="selected[]" class="form-check-input mt-0 selected" type="checkbox" value="'.$row->id.'">&nbsp;<span></span></label></span>';
                })
                ->addColumn('zip',function($row){
                    $zip = '';
                    return $zip;
                })
                ->addColumn('gender',function($row){
                    if($row->gender == 0)
                        return 'M';
                    else
                        return 'F';

                })
                ->rawColumns(['check','zip','gender'])
                ->make(true);

    }

    public function bulkRemove(Request $request)
    {
        foreach($request->selected as $id)
        {
            LeadDetail::where('id',$id)->delete();
        }
        return response(true);
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
