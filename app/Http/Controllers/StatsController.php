<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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

        $now = CarbonImmutable::now();
        $lastWeekStartDate = $now->startOfWeek()->subDay(7);
        $lastWeekEndDate = $now->startOfWeek()->subDay(1);
        $currentWeekStartDate = $now->startOfWeek();
        $currentWeekEndDate = $now->endOfWeek();
        // return $lastWeekStartDate.' --- '.$lastWeekEndDate.' --- '.$currentWeekStartDate.' --- '.$currentWeekEndDate;

        // $inventory = Lead::sum('total_row');
        $inventory = LeadDetail::where('is_send','=',0)->where('is_duplicate', 0)->where('is_invalid',0)->count();

        $totalLeads = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->count();
        // $newInventory = Lead::where('created_at', '>=', Carbon::now()->subDay(7))->sum('total_row');
        // $inventeryPercent = '';

        //if($totalInventory != 0 && $newInventory != 0 && $totalInventory-$newInventory !=0)
          //      $inventeryPercent = intval((intval($newInventory) * 100) / intval($totalInventory-$newInventory));

        // total revenue inc-dec in percentage calculation
        $lastWeekInventery = LeadDetail::where('is_send','>',0)->where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(7))->count();
        $lastWeekNewInventery = LeadDetail::where('is_send','=',0)->where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(7))->count();
        // $currentWeekInventery = LeadDetail::where('is_send','=',0)->where('is_duplicate', 0)->where('is_invalid',0)->whereBetween('created_at',[$currentWeekStartDate, $currentWeekEndDate])->count();
        // return $lastWeekInventery.' --- '.$currentWeekInventery;
        // if($lastWeekInventery > $currentWeekInventery) {
        //     if($currentWeekInventery != 0){
        //         $inventeryPercent = $lastWeekInventery - $currentWeekInventery;
        //         $inventeryPercent = round(($inventeryPercent/$currentWeekInventery)*100);
        //     } else {
        //         $inventeryPercent = round(($lastWeekInventery)*100);
        //     }
        //     $inventeryPercentType = "dec";
        // } else {
        //     if($lastWeekInventery != 0){
        //         $inventeryPercent = $currentWeekInventery - $lastWeekInventery;
        //         $inventeryPercent = round(($inventeryPercent/$lastWeekInventery)*100);
        //     } else {
        //         $inventeryPercent = 100;
        //     }
        //     $inventeryPercentType = "Inc";
        // }

        $inventeryPercent = 0;
        if($lastWeekInventery > 0) {
            $newInventory = $totalLeads - $lastWeekInventery;
            $inventeryPercent = round($newInventory / $totalLeads * 100);
        }
        // else {
        //     $inventeryPercent = round($lastWeekNewInventery / $totalLeads * 100);
        // }

        $totalLeadsCount = $totalLeads;
        $newLeads = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->where('created_at', '>=', Carbon::now()->subDay(7))->count();
        $leadsPercent = 0;

        if($newLeads > 0) {
            $leadsPercent = round($newLeads / $totalLeads * 100);
        }

        //if($totalLeads != 0 && $newLeads != 0 && $totalLeads-$newLeads !=0)
          //      $leadsPercent = intval((intval($newLeads) * 100) / intval($totalLeads-$newLeads));

        // total lead inc-dec in percentage calculation
        // $lstWeekLeads = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->whereBetween('created_at',[$lastWeekStartDate, $lastWeekEndDate])->count();
        // $currentWeekLeads = LeadDetail::where('is_duplicate', 0)->where('is_invalid',0)->whereBetween('created_at',[$currentWeekStartDate, $currentWeekEndDate])->count();
        // return $lstWeekLeads.' --- '.$currentWeekLeads;
        // if($lstWeekLeads > $currentWeekLeads) {
        //     if($currentWeekLeads != 0){
        //         $leadsPercent = $lstWeekLeads - $currentWeekLeads;
        //         $leadsPercent = round(($leadsPercent/$currentWeekLeads)*100);
        //     } else {
        //         $leadsPercent = round(($lstWeekLeads)*100);
        //     }
        //     $leadPercentType = "dec";
        // } else {
        //     if($lstWeekLeads != 0){
        //         $leadsPercent = $currentWeekLeads - $lstWeekLeads;
        //         $leadsPercent = round(($leadsPercent/$lstWeekLeads)*100);
        //     } else {
        //         $leadsPercent = 100;
        //     }
        //     $leadPercentType = "Inc";
        // }

        return view("$this->view/index", compact('moduleName','leadTypes','last24hours','last7days','last30days', 'totalLeadsCount','inventory','inventeryPercent','leadsPercent'));
    }

}
