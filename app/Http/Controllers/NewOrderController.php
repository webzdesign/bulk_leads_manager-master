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
use App\Models\SiteSetting;
use Auth,Validator,Carbon;

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
        ], [
            'first_name.required' => "Please enter first name.",
            'last_name.required' => "Please enter last name.",
            'email.required' => "Please enter email address.",
            'email.email' => "Please enter valid email formate.",
            'email.unique' => "Email already exist.",
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
                'added_by' => Auth::user()->id
            );
            Client::create($records);

            $response_arrray['message'] = "Client Added Successfully.";
            return response()->json([true, $response_arrray]);
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
                $country = isset($value->country) && $value->country !=null ? $value->country : '--';
                $state = isset($value->state) && $value->state !=null ? $value->state : '--';
                $city = isset($value->city) && $value->city !=null ? $value->city : '--';
                $ip_address = isset($value->ip_address) && $value->ip_address !=null ? $value->ip_address : '--';

                $html .= '<div class="col-md-12"><a href="javascript:void(0)" class="client_details" data-id='.$value->id.' data-first_name='.$value->firstName.' data-last_name='.$value->lastName.' data-email='.$value->email.' data-city='.$city.' data-state='.$state.' data-country='.$country.' data-ip_address='.$ip_address.'>'.$value->email.'</a></div>';
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
        $LeadTypes = LeadType::find($request->lead_type_id);
        $lead = $request->lead_type_id;
        $lead_id = Lead::where('lead_type_id',$request->lead_type_id)->exists();
        $setting = SiteSetting::find(1);
        $gender = isset($request->gender) && $request->gender !=null;
        $state_id = isset($request->state_id) && $request->state_id !=null;

        if($lead_id){

            $leads_details = LeadDetail::whereIn('lead_id',function($q) use($lead) {
                $q->select('id')->from('leads')->where('lead_type_id',$lead);
            })->where(['age_group_id' => $request->age_group_id,'is_duplicate' => 0,'is_invalid' => 0])->where('is_send','<',$setting->no_of_time_lead_download);
            $order_ids = Order::where(['client_id' => $request->client_id,'lead_type_id' => $request->lead_type_id,'age_group_id' => $request->age_group_id]);

            if(isset($request->gender) && $request->gender !=null){
                $leads_details->where('gender',$request->gender);
                $order_ids->where('gender',$request->gender)->orWhere('gender','')->orWhereNull('gender');
            }
            if(isset($request->state_id) && $request->state_id !=null){
                $leads_details->where('state_id',$request->state_id);
                $order_ids->where('state_id',$request->state_id)->orWhere('state_id','')->orWhereNull('state_id');
            }

            if($order_ids->exists()) {
                $skip_lead_details_id_exists = OrderDetail::whereIn('order_id',function($q) use($gender, $state_id, $request){
                    $q->select('id')->from('orders');
                    if($gender){
                        $q->where('gender', $request->gender)->orWhere('gender','')->orWhereNull('gender');
                    }
                    if($state_id){
                        $q->where('state_id', $request->state_id)->orWhere('state_id','')->orWhereNull('state_id');
                    }
                    $q->where(['client_id' => $request->client_id,'lead_type_id' => $request->lead_type_id,'age_group_id' => $request->age_group_id]);
                })->exists();

                if($skip_lead_details_id_exists) {
                    $leads_details->whereNotIn('id',function($qs) use($gender, $state_id, $request) {
                        $qs->select('lead_details_id')->from('order_details')->whereIn('order_id',function($qs) use($gender, $state_id, $request){
                            $qs->select('id')->from('orders');
                            if($gender){
                                $qs->where('gender', $request->gender)->orWhere('gender','')->orWhereNull('gender');
                            }
                            if($state_id){
                                $qs->where('state_id', $request->state_id)->orWhere('state_id','')->orWhereNull('state_id');
                            }
                            $qs->where(['client_id' => $request->client_id,'lead_type_id' => $request->lead_type_id,'age_group_id' => $request->age_group_id]);
                        });
                    });
                }
            }

            $leads_details = $leads_details->count();
            $total_leads_available = $leads_details;
        }

        return response()->json([true, ['total_leads_available' => $total_leads_available, 'LeadTypes' => $LeadTypes->name]]);
    }

    /* public function count_total_leads_available(Request $request){
        $total_leads_available = 0;
        $LeadTypes = LeadType::find($request->lead_type_id);
        $lead_id = Lead::where('lead_type_id',$request->lead_type_id)->pluck('id')->toArray();
        $setting = SiteSetting::find(1);

        if(count($lead_id) > 0){
            $leads_details = LeadDetail::whereIn('lead_id',$lead_id)->where(['age_group_id' => $request->age_group_id,'is_duplicate' => 0,'is_invalid' => 0])->where('is_send','<',$setting->no_of_time_lead_download);
            $order_ids = Order::where(['client_id' => $request->client_id,'lead_type_id' => $request->lead_type_id,'age_group_id' => $request->age_group_id]);

            if(isset($request->gender) && $request->gender !=null){
                $leads_details->where('gender',$request->gender);
                $order_ids->where('gender',$request->gender);
            }
            if(isset($request->state_id) && $request->state_id !=null){
                $leads_details->where('state_id',$request->state_id);
                $order_ids->where('state_id',$request->state_id);
            }

            //Skip lead details from client
            $order_ids = $order_ids->pluck('id')->toArray();

            if(isset($order_ids) && $order_ids !=null){
                $skip_lead_details_ids = OrderDetail::whereIn('order_id',$order_ids)->pluck('lead_details_id')->toArray();

                if(isset($skip_lead_details_ids) && $skip_lead_details_ids !=null){
                    $skip_lead_details_ids = array_unique($skip_lead_details_ids);
                    foreach(array_chunk($skip_lead_details_ids, 200) as $skip_lead_details_id) {
                        $leads_details->whereNotIn('id',$skip_lead_details_id);
                    }
                }
            }

            $leads_details = $leads_details->count();
            $total_leads_available = $leads_details;
        }

        return response()->json([true, ['total_leads_available' => $total_leads_available, 'LeadTypes' => $LeadTypes->name]]);
    } */
}
