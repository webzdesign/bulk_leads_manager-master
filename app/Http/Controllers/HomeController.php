<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use App\Models\Order;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public $moduleName = 'Dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request)
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::with(['ageGroup','leads'])->get();
        $orders = Order::with(['client','lead_type','age_group'])->orderBy('created_at', 'desc')->limit(2)->get();
        $Allleads = Lead::orderBy('created_at', 'desc')->limit(2)->get();
        return view('dashboard',compact('moduleName','leadTypes','orders','Allleads'));
    }

    public function getData(Request $request)
    {
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::all();
        if($request->type == 'order')
        {
            $orders = Order::with(['client','lead_type','age_group'])->orderBy('created_at', 'desc')->limit($request->limit)->get();
            return view('addedOrder',compact('orders'));
        }
        if($request->type == 'lead')
        {
            $leads = Lead::orderBy('created_at', 'desc')->limit($request->limit)->get();
            return view('addedLeads',compact('leads'));
        }

    }
}
