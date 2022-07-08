<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Clients;

class NewOrderController extends Controller
{
    public $moduleName = 'New order';

    public function index(){
        $moduleName = $this->moduleName;

        return view('new_order/index',compact('moduleName'));
    }

    public function create_client(Request $request){

        dd($request->all());

        $validation = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'ip_address' => ['required'],
        ], [
            'first_name.required' => "Please Enter First Name.",
            'last_name.required' => "Please Enter First Name.",
            'email.required' => "Please Enter First Name.",
            'email.email' => "Please Enter Valid Email Formate.",
            'city.required' => "Please Enter First Name.",
            'state.required' => "Please Enter First Name.",
            'country.required' => "Please Enter First Name.",
            'ip_address.required' => "Please Enter First Name.",
        ]);

        $records = array(
            'firstName' => $request['first_name'],
            'lastName' => $request['last_name'],
            'email' => $request['email'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'ip_address' => $request['ip_address'],
            'added_by' => Auth::user()->id,
            'updated_by' => 0,
        );
        Clients::create($records);
    }
}
