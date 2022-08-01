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
        $last24hours = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay())->count();
        $last7days = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(7))->count();
        $last30days = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(30))->count();

        $inventory = Lead::sum('total_row');

        $totalInventory =   $inventory;
        $newInventory = Lead::where('created_at', '>=', Carbon::now()->subDay(7))->sum('total_row');
        $inventeryPercent = '';

        if($totalInventory != 0 && $newInventory != 0 && $totalInventory-$newInventory !=0)
                $inventeryPercent = intval((intval($newInventory) * 100) / intval($totalInventory-$newInventory));


        $totalLeads = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->count();
        $newLeads = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(7))->count();
        $leadsPercent = '' ;

        if($totalLeads != 0 && $newLeads != 0 && $totalLeads-$newLeads !=0)
                $leadsPercent = intval((intval($newLeads) * 100) / intval($totalLeads-$newLeads));

        return view("$this->view/index", compact('moduleName','leadTypes','last24hours','last7days','last30days','inventory','inventeryPercent','leadsPercent'));
    }

}
