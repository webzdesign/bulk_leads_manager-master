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
        $moduleName = $this->moduleName;
        
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
        ]);
        if(isset($request->type) && $request->type == "UPDATE")
        {

         Client::find($request->id)->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'ip_address' => $request->ipAdrs,
            'updated_by' => auth()->user()->id,
        ]);
        $message = $moduleName." Updated Successfully.";

        }
        else
        {
            Client::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'city' => $request->city,
                'state'=> $request->state,
                'country' => $request->country,
                'ip_address' => $request->ipAdrs,
                'added_by' => auth()->user()->id,
            ]);
            $message = $moduleName." Added Successfully.";
        }
        return response()->json([true,$moduleName,$message]);
    }

    public function edit(Request $request)
    {
        $client = Client::where('id',$request->id)->first();
        if($client) {
            return response()->json($client);
        }
        else
        {
            return response()->json(false);
        }
    }

    public function delete(Request $request)
    {
        $client = Client::find($request->id);
        $client->delete();
        $message = $this->moduleName." Deleted Successfully.";
        return response()->json([true,$message]);
    }


    public function filter(Request $request)
    {
        $clients = [];
        if($request->state)
        {
            $clients = Client::where('state',$request->state)->get();
        }

        return response()->json(['html' => view('clients.filter', compact('clients'))->render()]);

    }

    public function checkEmailId(Request $request)
    {
        if($request->type == 'UPDATE')
        {
            $client = Client::where('email',$request->email)->where('id','!=',$request->id)->get()->count();
        }
        else
        {
            $client = Client::where('email', 'like', '%' . $request->email . '%')->get()->count();
        }

       if($client > 0)
       {
        return response()->json(false);
       }
       else
       {
        return response()->json(true);
       }

    }

}
