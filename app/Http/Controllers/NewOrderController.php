<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Auth,Validator,DB;

class NewOrderController extends Controller
{
    private $moduleName = 'New order';

    public function index(){
        $moduleName = $this->moduleName;

        return view('new_order/index',compact('moduleName'));
    }

    public function create_client(Request $request){
        $response_arrray = ['message' => ''];

        $validation = Validator::make($request->all(),[
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email','unique:clients,email'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'ip_address' => ['required'],
        ], [
            'first_name.required' => "Please enter first name.",
            'last_name.required' => "Please enter last name.",
            'email.required' => "Please enter email address.",
            'email.email' => "Please enter valid email formate.",
            'email.unique' => "Email already exist.",
            'city.required' => "Please enter city.",
            'state.required' => "Please enter state.",
            'country.required' => "Please enter country.",
            'ip_address.required' => "Please enter IP address.",
        ]);

        if ($validation->errors()->all()) {
            foreach ($validation->errors()->all() as $error) {
                $response_arrray['message'] = $error;
                return response()->json([false, $response_arrray]);
            }
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

            $response_arrray['message'] = "Client Added Successfully.";
            return response()->json([false, $response_arrray]);
        }
    }

    public function email_filter(Request $request){
        DB::enableQueryLog();
        $html = '';

        $records = Client::select('*')->where('email','LIKE', '%'.$request->email.'%')->get();

        if($records->isNotEmpty() && $request->email !=''){
            foreach ($records as $key => $value) {
                $html .= '<div><a href="javascript:void(0);" data-id='.$value->id.' data-first_name='.$value->firstName.' data-last_name='.$value->lastName.' data-email='.$value->email.' data-city='.$value->city.' data-state='.$value->state.' data-country='.$value->country.' data-ip_address='.$value->ip_address.'>'.$value->email.'</a></div>';
            }
            return response()->json([true, ['html' => $html]]);
        }else{
            return response()->json([false, '']);
        }
    }
}
