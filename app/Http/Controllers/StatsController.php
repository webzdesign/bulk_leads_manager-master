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
        $last24hours = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay())->get()->count();
        $last7days = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(7))->get()->count();
        $last30days = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(30))->get()->count();
        return view("$this->view/index", compact('moduleName','leadTypes','last24hours','last7days','last30days'));
    }

}
