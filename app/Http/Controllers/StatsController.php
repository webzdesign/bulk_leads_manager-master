<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadType;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    //
    private $moduleName = "Stats";
    private $view = "stats";

    public function index()
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::all();
        $leads = Lead::all();
        return view("$this->view/index", compact('moduleName'));
    }
}
