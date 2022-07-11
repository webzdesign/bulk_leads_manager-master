<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Client;
use App\Models\LeadType;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    private $moduleName = "Clients";
    private $view = "clients";

    public function index()
    {
        $moduleName = $this->moduleName;
        $clients = Client::all();
        $leadType = LeadType::all();
        $ageGroup = AgeGroup::with('leadType')->get();
        $states = Client::all()->pluck('state')->toArray();
        return view($this->view.'/index',compact('moduleName','clients','leadType','ageGroup','states'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

}
