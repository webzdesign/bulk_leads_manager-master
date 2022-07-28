<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use Carbon\Carbon;
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
        $last24hours = LeadDetail::where('created_at', '>=', Carbon::now()->subDay())->get();
        dd($last24hours);
        return view("$this->view/index", compact('moduleName','leadTypes'));
    }

    public function getStats()
    {
        dd("hello");
    }
}
