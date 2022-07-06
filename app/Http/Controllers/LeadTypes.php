<?php

namespace App\Http\Controllers;

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
        return view("$this->view/index", compact('moduleName','LeadTypes'));
    }

    public function store_lead_type(Request $request)
    {
        $validate = $request->validate([
            'lead_type' => 'required'
        ]);

        $LeadType = LeadType::create(['name' => $request->lead_type, 'added_by' => auth()->user()->id]);

        if($LeadType) {
            return response()->json(true);
        }
    }

}
