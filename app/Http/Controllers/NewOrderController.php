<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Auth;
use Validator;

class NewOrderController extends Controller
{
    private $moduleName = 'New order';

    public function index(){
        $moduleName = $this->moduleName;

        return view('new_order/index',compact('moduleName'));
    }

    public function create_client(Request $request){
        $response_arrray = ['status' => false, 'message' => ''];

        $validation = Validator::make($request->all(),[
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email','unique:clients,email'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'ip_address' => ['required'],
        ], [
            'first_name.required' => "Please Enter First Name.",
            'last_name.required' => "Please Enter First Name.",
            'email.required' => "Please Enter First Name.",
            'email.email' => "Please Enter Valid Email Formate.",
            'email.unique' => "Email Already Exist.",
            'city.required' => "Please Enter First Name.",
            'state.required' => "Please Enter First Name.",
            'country.required' => "Please Enter First Name.",
            'ip_address.required' => "Please Enter First Name.",
        ]);

        if($validation->errors()){
            // foreach ($validation->errors() as $key => $value) {
                $response_arrray[] = $validation->errors();
                // break;
            // }
            // dd($response_arrray);
            return response()->json([true,$this->moduleName,$response_arrray]);
        }else {
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
            Client::create($records);

            $response_arrray['status'] = true;
            $response_arrray['message'] = "Client Added Successfully.";
        }
        return response()->json([true,$this->moduleName,$response_arrray]);
    }
}
