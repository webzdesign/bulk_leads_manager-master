<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\State;
use App\Models\LeadType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeadsController extends Controller
{
    private $moduleName = "Leads";
    private $view = "Leads";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::select('id', 'name')->get();
        $states = State::select('id', 'name')->get();
        $leadAge = AgeGroup::with('leadType')->get();

        return view("$this->view/index", compact('moduleName', 'leadTypes', 'leadAge', 'states'));
    }

    public function getData(Request $request)
    {
        $leadDetail = LeadDetail::with('lead')->select('lead_details.*')->where('is_duplicate',0)->where('is_invalid',0)->orderBy('id','DESC');

        if ($request->leadType) {
            $leadDetail = $leadDetail->whereHas('lead', function($q) use($request){
                $q->where('lead_type_id', $request->leadType);
            });
        }

        if ($request->leadAge) {
            $leadDetail->where('age_group_id', $request->leadAge);
        }

        if ($request->gender) {
            if ($request->gender == 'M') {
                $leadDetail->where('gender', 0);
            } else if($request->gender == 'F') {
                $leadDetail->where('gender', 1);
            }
        }

        if ($request->state) {
            $leadDetail->where('state_id', $request->state);
        }

        return DataTables::eloquent($leadDetail)
            ->addColumn('check', function ($row) {
                return '<span style="width: 50px;">
                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                <input name="selected[]" class="form-check-input mt-0 selected" type="checkbox" value="'.$row->id.'">&nbsp;<span></span></label></span>';
            })
            ->addColumn('gender',function($row){
                if($row->gender === null)
                    return '--';
                elseif($row->gender == 1)
                    return 'F';
                else
                    return 'M';

            })
            ->editColumn('state_id',function($row){
                if($row->state)
                return $row->state->name;
                else
                return '--';
            })
            ->editColumn('email',function($row){
                if($row->email)
                return $row->email;
                else
                return '--';
            })
            ->editColumn('age',function($row){
                if($row->age)
                return $row->age .' D';
                else
                return '--';
                })
            ->rawColumns(['check','zip','gender','state_id','email','age'])
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

    /* public static function leadSync()
    {
        $leadDetails = LeadDetail::with('lead')->whereNotNull('date_generated')->where('is_duplicate',0)->where('is_invalid',0);

        $totalRec = $leadDetails->count();
        $totalPage = ceil($totalRec / 1000);

        for ($p = 0; $p < $totalPage; $p++) {
            $skip = $p * 1000;
            $leadDetails = LeadDetail::with('lead')->whereNotNull('date_generated')->skip($skip)->take(1000)->get();

            foreach ($leadDetails as $leadDetail) {
                $leadTypeId = $leadDetail->lead->lead_type_id;

                $today = date('Y-m-d');
                $date1 = date_create($leadDetail->date_generated);
                $date2 = date_create($today);
                $diff  = date_diff($date1,$date2);
                $diffDays = intval($diff->format("%a"));

                $ageGroup = AgeGroup::select('id')->where('lead_type_id', $leadTypeId)->where('age_from', '<=', $diffDays)->where('age_to', '>=', $diffDays)->first();
                if ($ageGroup) {
                    $ageGroupId = $ageGroup->id;
                } else {
                    $ageGroupId = null;
                }
                echo $leadDetail->id.'<br/>';
                LeadDetail::find($leadDetail->id)->update(['age_group_id' => $ageGroupId, 'age' => $diffDays]);
            }
        }
    } */
}
