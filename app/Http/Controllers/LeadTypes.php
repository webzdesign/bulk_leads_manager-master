<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\LeadType;
use Illuminate\Http\Request;

class LeadTypes extends Controller
{
    private $moduleName = "Lead Types";
    private $view = "lead_types";

    public function index()
    {
        $moduleName = $this->moduleName;
        $LeadTypes = LeadType::get();
        $ageGroups = AgeGroup::get();
        return view("$this->view/index", compact('moduleName','LeadTypes','ageGroups'));
    }

    public function store_lead_type(Request $request)
    {
        $validate = $request->validate([
            'lead_type' => 'required'
        ]);

        $moduleName = $this->moduleName;
        if(isset($request->type)) {
            $LeadType = LeadType::find($request->id);
            $LeadType->update(['name' => $request->lead_type, 'updated_by' => auth()->user()->id]);
            $message = $moduleName." Updated Successfully.";
        } else {
            $LeadType = LeadType::create(['name' => $request->lead_type, 'added_by' => auth()->user()->id]);
            $message = $moduleName." Added Successfully.";
        }

        return response()->json([true,$moduleName,$message]);
    }

    public function edit(Request $request)
    {
        $LeadType = LeadType::find($request->id);
        return response()->json([true,$LeadType->name]);
    }

    public function delete(Request $request)
    {
        $LeadType = LeadType::find($request->id);
        $LeadType->delete();
        $message = $this->moduleName." Deleted Successfully.";
        return response()->json([true,$message]);
    }

}
