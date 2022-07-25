<?php

namespace App\Http\Controllers;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($more = null)
    {
       isset($more)? $more = $more : $more = 2;
        // dd($more);
        $moduleName = $this->moduleName;
        $leadTypes = LeadType::all();
        $orders = Order::with(['client','lead_type','age_group'])->orderBy('created_at', 'desc')->limit($more)->get();
        return view('dashboard',compact('moduleName','leadTypes','orders'));
    }
}
