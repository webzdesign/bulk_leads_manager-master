<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\AgeGroup;
use App\Models\LeadFields;
use App\Models\Lead;
use App\Models\LeadType;
use App\Models\LeadDetail;
use App\Models\State;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth,Validator,DB,ckeditor,Carbon;

class NewOrderController extends Controller
{
    private $moduleName = 'New order';

    public function index(){
        $moduleName = $this->moduleName;
        $LeadTypes = LeadType::orderBy('id','desc')->get();
        $States = State::orderBy('id','desc')->get();

        return view('new_order/index',compact('moduleName','LeadTypes','States'));
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

    public function create_order(Request $request){
        $response_arrray = ['message' => ''];
        $mytime = Carbon\Carbon::now();
        $order_date = $mytime->toDateTimeString();

        $validation = Validator::make($request->all(),[
            'client_id' => ['required'],
            'lead_type_id' => ['required'],
            'age_group_id' => ['required'],
            'qty' => ['required','numeric'],
            'lead_quantity' => ['required','numeric','lte:'.$request->total_leads_available],
        ], [
            'client_id.required' => "Please select client.",
            'lead_type_id.required' => "Please select lead type.",
            'age_group_id.required' => "Please select age group.",
            'qty.required' => "Please enter quantity.",
            'qty.numeric' => "Quantity not allowed alpha numeric.",
            'lead_quantity.required' => "Please enter lead quantity.",
            'lead_quantity.numeric' => "Lead quantity not allowed alpha numeric.",
            'lead_quantity.lte' => "Quantity can\'t be add greater than of total leads.",
        ]);

        if ($validation->errors()->all()) {
            foreach ($validation->errors()->all() as $error) {
                $response_arrray['message'] = $error;
                return response()->json([false, $response_arrray]);
            }
        }else {
            $records = array(
                'order_date' => $order_date,
                'client_id' => $request['client_id'],
                'lead_type_id' => $request['lead_type_id'],
                'age_group_id' => $request['age_group_id'],
                'qty' => $request['lead_quantity'],
                'gender' => $request['gender'],
                'state_id' => $request['state_id'],
                'status' => '0',
                'added_by' => Auth::user()->id
            );
            Order::create($records);

            $response_arrray['message'] = $this->moduleName." Created Successfully.";
            return response()->json([true, $response_arrray]);
        }
    }

    public function email_filter(Request $request){
        $html = '';
        $records = Client::select('*')->where('email','LIKE', '%'.$request->email.'%')->get();

        if($records->isNotEmpty() && $request->email !=''){
            foreach ($records as $key => $value) {
                $html .= '<div class="col-md-12"><a href="javascript:void(0)" class="client_details" data-id='.$value->id.' data-first_name='.$value->firstName.' data-last_name='.$value->lastName.' data-email='.$value->email.' data-city='.$value->city.' data-state='.$value->state.' data-country='.$value->country.' data-ip_address='.$value->ip_address.'>'.$value->email.'</a></div>';
            }
            return response()->json([true, ['html' => $html]]);
        }else{
            return response()->json([false, '']);
        }
    }

    public function age_group(Request $request){
        $html = '';
        $records = AgeGroup::where('lead_type_id',$request->lead_type_id)->get();

        $html .='<option value="">Select Age</option>';
        if($records->isNotEmpty()){
            foreach ($records as $key => $value) {
                $html .= '<option value="'.$value->id.'">'.$value->age_from.' '.$value->age_to.'</option>';
            }
            return response()->json([true, ['html' => $html]]);
        }else{
            return response()->json([false, ['html' => $html]]);
        }
    }

    public function count_total_leads_available(Request $request){
        $total_leads_available = 0;

        $lead_id = Lead::where('lead_type_id',$request->lead_type_id)->pluck('id')->toArray();

        if(count($lead_id) > 0){
            $leads_details = LeadDetail::whereIn('lead_id',$lead_id);

            if(isset($request->gender) && $request->gender !=null){
                $leads_details->where('gender',$request->gender);
            }
            if(isset($request->state_id) && $request->state_id !=null){
                $leads_details->where('state_id',$request->state_id);
            }
            $leads_details = $leads_details->count();
            $total_leads_available = $leads_details;
        }

        return response()->json([true, ['total_leads_available' => $total_leads_available]]);
    }
}
