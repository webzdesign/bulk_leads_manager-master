<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Lead;
use App\Models\Order;
use App\Models\State;
use App\Models\Client;
use App\Models\AgeGroup;
use App\Models\LeadType;
use App\Models\LeadDetail;
use App\Models\OrderDetail;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use DataTables,Mail,Storage;
use App\Exports\LeadDetailsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
class OrdersController extends Controller
{
    private $moduleName = "Orders";
    private $view = "orders";

    public function index()
    {
        $moduleName = $this->moduleName;
        $lead_type = LeadType::orderBy('id','desc')->get();
        $age_group = AgeGroup::orderBy('id','desc')->get();
        $state = State::orderBy('id','desc')->get();

        return view("$this->view/index", compact('moduleName','lead_type','age_group','state'));
    }

    public function getData(Request $request)
    {
        $orders = Order::with(['client','lead_type','age_group'])->select('*')->orderBy('created_at','desc');

        if($request->lead_type_id !=''){
            $orders->where('lead_type_id',$request->lead_type_id);
        }
        if($request->age_group_id !=''){
            $orders->where('age_group_id',$request->age_group_id);
        }
        if($request->gender !=''){
            $orders->where('gender',$request->gender);
        }
        if($request->state_id !=''){
            $orders->where('state_id',$request->state_id);
        }

        $datatable = Datatables()->eloquent($orders)
            ->addColumn('first_name',function($row){
                return isset($row->client) && $row->client !=null ? $row->client['firstName'] : 'N/A';
            })
            ->addColumn('last_name',function($row){
                return isset($row->client) && $row->client !=null ? $row->client['lastName'] : 'N/A';
            })
            ->addColumn('email',function($row){
                return isset($row->client) && $row->client !=null ? $row->client['email'] : 'N/A';
            })
            ->editColumn('order_date',function($row){
                return date('d/m/y',strtotime($row->order_date));
            })
            ->addColumn('last_product_ordered',function($row){
                $age_group = $row->qty;
                return ($age_group > 0 ? $age_group.' '.$row->lead_type->name.' | ' : '').$row->age_group->age_from.'-'.$row->age_group->age_to.' Days';
            })
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $actions = '';
                $url = url('download/'.$row->file_name);
                if($row->status == '1'){
                    $actions .= '<div class="editDlbtn d-flex">
                        <a href="javascript:void(0)" class="resend_order" data-order_id="'.$row->id.'">
                            <button class="cartBtn w-auto px-3 text-white f-500">
                                <svg class="me-2" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8334 11.9999C11.0934 11.9999 10.5001 12.5933 10.5001 13.3333C10.5001 13.6869 10.6406 14.026 10.8906 14.2761C11.1407 14.5261 11.4798 14.6666 11.8334 14.6666C12.187 14.6666 12.5262 14.5261 12.7762 14.2761C13.0263 14.026 13.1667 13.6869 13.1667 13.3333C13.1667 12.5933 12.5667 11.9999 11.8334 11.9999ZM1.16675 1.33325V2.66659H2.50008L4.90008 7.72659L3.99341 9.35992C3.89341 9.54659 3.83341 9.76659 3.83341 9.99992C3.83341 10.3535 3.97389 10.6927 4.22394 10.9427C4.47399 11.1928 4.81313 11.3333 5.16675 11.3333H13.1667V9.99992H5.44675C5.40254 9.99992 5.36015 9.98236 5.3289 9.9511C5.29764 9.91985 5.28008 9.87745 5.28008 9.83325C5.28008 9.79992 5.28675 9.77325 5.30008 9.75325L5.90008 8.66659H10.8667C11.3667 8.66659 11.8067 8.38659 12.0334 7.97992L14.4201 3.66659C14.4667 3.55992 14.5001 3.44659 14.5001 3.33325C14.5001 3.15644 14.4298 2.98687 14.3048 2.86185C14.1798 2.73682 14.0102 2.66659 13.8334 2.66659H3.97341L3.34675 1.33325H1.16675ZM5.16675 11.9999C4.42675 11.9999 3.83341 12.5933 3.83341 13.3333C3.83341 13.6869 3.97389 14.026 4.22394 14.2761C4.47399 14.5261 4.81313 14.6666 5.16675 14.6666C5.52037 14.6666 5.85951 14.5261 6.10956 14.2761C6.3596 14.026 6.50008 13.6869 6.50008 13.3333C6.50008 12.5933 5.90008 11.9999 5.16675 11.9999Z" fill="white"/>
                                </svg>
                                Resend Order
                            </button>
                        </a>

                        <a href="'.$url.'">
                            <button class="cartBtn w-auto px-3 text-white f-500" style="background: #04baf1;">
                                <svg class="me-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1701_5415)"><path d="M17.125 12.875H12.4316L10.8408 14.4658C10.4172 14.8895 9.85117 15.125 9.25 15.125C8.64883 15.125 8.08422 14.891 7.65918 14.4658L6.06836 12.875H1.375C0.753789 12.875 0.25 13.3788 0.25 14V17.375C0.25 17.9962 0.753789 18.5 1.375 18.5H17.125C17.7462 18.5 18.25 17.9962 18.25 17.375V14C18.25 13.3777 17.7473 12.875 17.125 12.875ZM15.4375 16.5312C14.9734 16.5312 14.5938 16.1516 14.5938 15.6875C14.5938 15.2234 14.9734 14.8438 15.4375 14.8438C15.9016 14.8438 16.2812 15.2234 16.2812 15.6875C16.2812 16.1516 15.9016 16.5312 15.4375 16.5312ZM8.45547 13.6695C8.67344 13.891 8.96172 14 9.25 14C9.53828 14 9.82586 13.8901 10.0452 13.6704L14.5452 9.17041C14.9843 8.73096 14.9843 8.01904 14.5452 7.57959C14.1058 7.14014 13.3935 7.14014 12.9544 7.57959L10.375 10.1609V1.625C10.375 1.00379 9.87121 0.5 9.25 0.5C8.62773 0.5 8.125 1.00379 8.125 1.625V10.1609L5.54453 7.58047C5.10543 7.14102 4.39316 7.14102 3.95371 7.58047C3.51461 8.01992 3.51461 8.73184 3.95371 9.17129L8.45547 13.6695Z" fill="white"></path></g><defs><clipPath id="clip0_1701_5415"><rect width="18" height="18" fill="white" transform="translate(0.25 0.5)"></rect></clipPath></defs>
                                </svg>
                                Download Order
                            </button>
                        </a>
                    </div>';
                } else {
                    $actions .= '<div class="editDlbtn d-flex">
                        <a href="javascript:void(0)">
                            <button class="cartBtn w-auto px-3 text-white f-500" style="background: darkorange;">
                                <svg class="me-2" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8334 11.9999C11.0934 11.9999 10.5001 12.5933 10.5001 13.3333C10.5001 13.6869 10.6406 14.026 10.8906 14.2761C11.1407 14.5261 11.4798 14.6666 11.8334 14.6666C12.187 14.6666 12.5262 14.5261 12.7762 14.2761C13.0263 14.026 13.1667 13.6869 13.1667 13.3333C13.1667 12.5933 12.5667 11.9999 11.8334 11.9999ZM1.16675 1.33325V2.66659H2.50008L4.90008 7.72659L3.99341 9.35992C3.89341 9.54659 3.83341 9.76659 3.83341 9.99992C3.83341 10.3535 3.97389 10.6927 4.22394 10.9427C4.47399 11.1928 4.81313 11.3333 5.16675 11.3333H13.1667V9.99992H5.44675C5.40254 9.99992 5.36015 9.98236 5.3289 9.9511C5.29764 9.91985 5.28008 9.87745 5.28008 9.83325C5.28008 9.79992 5.28675 9.77325 5.30008 9.75325L5.90008 8.66659H10.8667C11.3667 8.66659 11.8067 8.38659 12.0334 7.97992L14.4201 3.66659C14.4667 3.55992 14.5001 3.44659 14.5001 3.33325C14.5001 3.15644 14.4298 2.98687 14.3048 2.86185C14.1798 2.73682 14.0102 2.66659 13.8334 2.66659H3.97341L3.34675 1.33325H1.16675ZM5.16675 11.9999C4.42675 11.9999 3.83341 12.5933 3.83341 13.3333C3.83341 13.6869 3.97389 14.026 4.22394 14.2761C4.47399 14.5261 4.81313 14.6666 5.16675 14.6666C5.52037 14.6666 5.85951 14.5261 6.10956 14.2761C6.3596 14.026 6.50008 13.6869 6.50008 13.3333C6.50008 12.5933 5.90008 11.9999 5.16675 11.9999Z" fill="white"/>
                                </svg>
                                Pending Order
                            </button>
                        </a>
                    </div>';
                }
                return $actions;
        })
        ->rawColumns(['first_name','last_name','email','order_date','last_product_ordered','action'])
        ->make(true);

        return $datatable;
    }

    // public static function sendLead($order_id = ''){

    //     $setting = SiteSetting::find(1);
    //     $status = isset($order_id) && $order_id !=null ? '1' : '0';

    //     $order_data = Order::with(['client'])->where('status',$status);
    //     if(isset($order_id) && $order_id !=null){

    //         $value = $order_data->where('id',$order_id)->first();
    //         $site_setting = SiteSetting::first()->toArray();
    //         $file_name = $value->file_name;

    //         $from_email = isset($site_setting['email_from_address']) && $site_setting['email_from_address'] !=null ? $site_setting['email_from_address'] : '';
    //         $from_name = isset($site_setting['email_from_name']) && $site_setting['email_from_name'] !=null ? $site_setting['email_from_name'] : '';
    //         $bcc_email = isset($site_setting['bcc_email_address']) && $site_setting['bcc_email_address'] !=null ? $site_setting['bcc_email_address'] : '';
    //         $replay_email = isset($site_setting['reply_to_email']) && $site_setting['reply_to_email'] !=null ? $site_setting['reply_to_email'] : '';

    //         $client_email = $value->client->email;
    //         $to_email = [$client_email,$from_email];

    //         Mail::send('mail/leadreport', ['order_data' => $value, 'file' => $file_name], function($message) use ($to_email,$from_email,$from_name,$bcc_email,$replay_email){

    //             $message->from($from_email, $from_name);
    //             if($bcc_email !=''){
    //                 $message->bcc([$bcc_email]);
    //             }
    //             if($replay_email !=''){
    //                 $message->replyTo($replay_email);
    //             }
    //             $message->to($to_email)->subject('Leads send');
    //         });

    //         echo "Lead details send successfuly.";
    //         return true;
    //         // $order_data->where('id',$order_id);
    //     }
    //     $order_data = $order_data->get();

    //     $lead_response = [];

    //     if(!$order_data->isEmpty()){
    //         foreach($order_data as $key => $value){
    //             $lead_collection = [];

    //             $lead_ids = Lead::where(['lead_type_id' => $value->lead_type_id])->pluck('id')->toArray();

    //             if(isset($lead_ids) && $lead_ids !=null){
    //                 if($order_id == ''){
    //                     // $skip_lead_details_ids = OrderDetail::where(['order_id' => $value->id])->pluck('lead_details_id')->toArray();
    //                     $clientOrderId = Order::where('client_id',$value->client_id)->pluck('id');
    //                     $skip_lead_details_ids = OrderDetail::whereIn('order_id',$clientOrderId)->pluck('lead_details_id')->toArray();
    //                 }
    //                 $lead_details = LeadDetail::with(['lead','country','state','city'])->whereIn('lead_id',$lead_ids)->where(['age_group_id' => $value->age_group_id,'is_duplicate' => 0]);

    //                 if($order_id == '') {
    //                     $lead_details->where('is_send','<',$setting->no_of_time_lead_download);
    //                 }
    //                 if(isset($value->state_id) && $value->state_id !=null){
    //                     $lead_details->where('state_id',$value->state_id);
    //                 }
    //                 if(isset($value->gender) && $value->gender !=null){
    //                     $lead_details->where('gender',$value->gender);
    //                 }
    //                 if(isset($skip_lead_details_ids) && $skip_lead_details_ids !=null){
    //                     foreach(array_chunk($skip_lead_details_ids, 200) as $skip_lead_details_id) {
    //                         $lead_details->whereNotIn('id',$skip_lead_details_id);
    //                     }
    //                 }
    //                 // if(isset($order_id) && $order_id != null) {
    //                 //     $orderDetailsID = OrderDetail::where('order_id',$order_id)->get()->pluck('lead_details_id')->toArray();
    //                 //     $lead_details->whereIn('id',$orderDetailsID);
    //                 // }

    //                 // $lead_details = $lead_details->get()->take($value->qty);
    //                 $lead_details = $lead_details->limit($value->qty)->get();

    //                 if(isset($lead_details) && $lead_details !=null){

    //                     foreach ($lead_details as $key => $row) {
    //                         $age_group = AgeGroup::where('id',$row->age_group_id)->get();

    //                         $age_from = !$age_group->isEmpty() ? $age_group[0]->age_from : '';
    //                         $age_to = !$age_group->isEmpty() ? $age_group[0]->age_to : '';

    //                         $lead_collection[] = array(
    //                             'age_group' => $age_from.' - '.$age_to,
    //                             'first_name' => $row->first_name,
    //                             'last_name' => $row->last_name,
    //                             'gender' => $row->gender == 0 ? 'Male' : ($row->gender == 1 ? 'Female' : ''),
    //                             'email' => $row->email,
    //                             'address' => $row->address,
    //                             'country' => isset($row->country->name) && $row->country->name !=null ? $row->country->name : '',
    //                             'state' => isset($row->state->name) && $row->state->name !=null ? $row->state->name : '',
    //                             'city' => isset($row->city->name) && $row->city->name !=null ? $row->city->name : '',
    //                             'phone_number' => $row->phone_number,
    //                             'birth_date' => $row->birth_date,
    //                             'age' => isset($row->age) && $row->age !=null ? $row->age : 'N/A',
    //                             'zip' => isset($row->zip) && $row->zip !=null ? $row->zip : 'N/A',
    //                         );

    //                         //Add records
    //                         $where_array = ['order_id' => $value->id, 'lead_details_id' => $row->id];
    //                         OrderDetail::updateOrCreate($where_array,['order_id' => $value->id, 'lead_details_id' => $row->id]);

    //                         if($order_id == '') {
    //                             LeadDetail::where('id', $row->id)->increment('is_send', 1);
    //                         }
    //                     }

    //                     if(isset($lead_collection) && $lead_collection !=null){

    //                         $file_name = 'LeadReport-'.uniqid().'.csv';
    //                         $lead_response = Excel::store(new LeadDetailsExport($lead_collection), $file_name, 'leadreport'); //Third parameter is storage path if check path to config/filesystem.php

    //                         //Mail sending
    //                         $site_setting = SiteSetting::first()->toArray();

    //                         $from_email = isset($site_setting['email_from_address']) && $site_setting['email_from_address'] !=null ? $site_setting['email_from_address'] : '';
    //                         $from_name = isset($site_setting['email_from_name']) && $site_setting['email_from_name'] !=null ? $site_setting['email_from_name'] : '';
    //                         $bcc_email = isset($site_setting['bcc_email_address']) && $site_setting['bcc_email_address'] !=null ? $site_setting['bcc_email_address'] : '';
    //                         $replay_email = isset($site_setting['reply_to_email']) && $site_setting['reply_to_email'] !=null ? $site_setting['reply_to_email'] : '';

    //                         $client_email = $value->client->email;
    //                         $to_email = [$client_email,$from_email];
    //                         $upload_path = 'storage/leadreport/'.$file_name;

    //                         Mail::send('mail/leadreport', ['order_data' => $value, 'file' => $file_name], function($message) use ($to_email,$from_email,$from_name,$bcc_email,$replay_email){

    //                             $message->from($from_email, $from_name);
    //                             if($bcc_email !=''){
    //                                 $message->bcc([$bcc_email]);
    //                             }
    //                             if($replay_email !=''){
    //                                 $message->replyTo($replay_email);
    //                             }
    //                             $message->to($to_email)->subject('Leads send');
    //                         });

    //                         // Update order status
    //                         Order::where('id', $value->id)->update(['status' => '1','file_name' => $file_name]);
    //                     }
    //                 }
    //             }
    //         }

    //         if(isset($lead_response) && $lead_response !=null){
    //             echo "Lead details send successfuly.";
    //             return $lead_response;
    //         }
    //     }
    // }

    public static function sendLead($order_id = ''){


        $setting = SiteSetting::find(1);
        $status = isset($order_id) && $order_id !=null ? '1' : '0';

        $order_data = Order::select('id','lead_type_id','age_group_id','client_id','state_id','gender','qty')->with(['client'=>function($query){
            $query->select('id', 'email');
        }])->where('status',$status);

        if(isset($order_id) && $order_id !=null){ //resend

            $value = $order_data->where('id',$order_id)->first();
            $site_setting = SiteSetting::first()->toArray();
            $file_name = $value->file_name;

            $from_email = isset($site_setting['email_from_address']) && $site_setting['email_from_address'] !=null ? $site_setting['email_from_address'] : '';
            $from_name = isset($site_setting['email_from_name']) && $site_setting['email_from_name'] !=null ? $site_setting['email_from_name'] : '';
            $bcc_email = isset($site_setting['bcc_email_address']) && $site_setting['bcc_email_address'] !=null ? $site_setting['bcc_email_address'] : '';
            $replay_email = isset($site_setting['reply_to_email']) && $site_setting['reply_to_email'] !=null ? $site_setting['reply_to_email'] : '';

            $client_email = $value->client->email;
            $to_email = [$client_email,$from_email];

            Mail::send('mail/leadreport', ['order_data' => $value, 'file' => $file_name], function($message) use ($to_email,$from_email,$from_name,$bcc_email,$replay_email){

                $message->from($from_email, $from_name);
                if($bcc_email !=''){
                    $message->bcc([$bcc_email]);
                }
                if($replay_email !=''){
                    $message->replyTo($replay_email);
                }
                $message->to($to_email)->subject('Leads send');
            });

            echo "Lead details send successfuly.";
            return true;
            // $order_data->where('id',$order_id);
        }

        $order_data = $order_data->get();

        $lead_response = [];

        if(!$order_data->isEmpty()){ // lead:send

            foreach($order_data as $key => $value){

                $lead_collection = [];
                if(Lead::where(['lead_type_id' => $value->lead_type_id])->exists()){
                    if($order_id == ''){
                        $clientOrderId = Order::where('client_id',$value->client_id)->pluck('id');
                        $skip_lead_details_ids = OrderDetail::whereIn('order_id',$clientOrderId)->pluck('lead_details_id')->toArray();
                    }
                    $leadIds = $value->lead_type_id;
                    $lead_details = LeadDetail::with(['lead' => function($q) use($leadIds){
                        $q->where('lead_type_id',$leadIds);
                    }])->with(['country','state','city'])->where(['age_group_id' => $value->age_group_id,'is_duplicate' => 0]);

                    if($order_id == '') {
                        $lead_details->where('is_send','<',$setting->no_of_time_lead_download);
                    }
                    if(isset($value->state_id) && $value->state_id !=null){
                        $lead_details->where('state_id',$value->state_id);
                    }
                    if(isset($value->gender) && $value->gender !=null){
                        $lead_details->where('gender',$value->gender);
                    }
                    if(isset($skip_lead_details_ids) && $skip_lead_details_ids !=null){
                        foreach(array_chunk($skip_lead_details_ids, 200) as $skip_lead_details_id) {
                            $lead_details->whereNotIn('id',$skip_lead_details_id);
                        }
                    }
                    // if(isset($order_id) && $order_id != null) {
                    //     $orderDetailsID = OrderDetail::where('order_id',$order_id)->get()->pluck('lead_details_id')->toArray();
                    //     $lead_details->whereIn('id',$orderDetailsID);
                    // }

                    // $lead_details = $lead_details->get()->take($value->qty);
                    $lead_details = $lead_details->limit($value->qty)->get();
                    $order_details = array();
                    if(isset($lead_details) && $lead_details !=null){

                        foreach ($lead_details as $key => $row) {
                            $age_group = AgeGroup::where('id',$row->age_group_id)->get();

                            $age_from = !$age_group->isEmpty() ? $age_group[0]->age_from : '';
                            $age_to = !$age_group->isEmpty() ? $age_group[0]->age_to : '';

                            $lead_collection[] = array(
                                'age_group' => $age_from.' - '.$age_to,
                                'first_name' => $row->first_name,
                                'last_name' => $row->last_name,
                                'gender' => $row->gender == 0 ? 'Male' : ($row->gender == 1 ? 'Female' : ''),
                                'email' => $row->email,
                                'address' => $row->address,
                                'country' => isset($row->country->name) && $row->country->name !=null ? $row->country->name : '',
                                'state' => isset($row->state->name) && $row->state->name !=null ? $row->state->name : '',
                                'city' => isset($row->city->name) && $row->city->name !=null ? $row->city->name : '',
                                'phone_number' => $row->phone_number,
                                'birth_date' => $row->birth_date,
                                'age' => isset($row->age) && $row->age !=null ? $row->age : 'N/A',
                                'zip' => isset($row->zip) && $row->zip !=null ? $row->zip : 'N/A',
                            );

                            //Add/Update records array
                            $order_details[] = ['order_id' => $value->id, 'lead_details_id' => $row->id];

                            if($order_id == '') {
                                LeadDetail::where('id', $row->id)->increment('is_send', 1);
                            }
                        }

                        if(count($order_details)) {
                            foreach(array_chunk($order_details, 2000) as $order_detail) {
                                DB::table('order_details')->upsert($order_detail, ['order_id', 'lead_details_id'], ['order_id', 'lead_details_id']);
                            }
                        }

                        if(isset($lead_collection) && $lead_collection !=null){

                            $file_name = 'LeadReport-'.uniqid().'.csv';
                            $lead_response = Excel::store(new LeadDetailsExport($lead_collection), $file_name, 'leadreport'); //Third parameter is storage path if check path to config/filesystem.php

                            //Mail sending
                            $site_setting = SiteSetting::first()->toArray();

                            $from_email = isset($site_setting['email_from_address']) && $site_setting['email_from_address'] !=null ? $site_setting['email_from_address'] : '';
                            $from_name = isset($site_setting['email_from_name']) && $site_setting['email_from_name'] !=null ? $site_setting['email_from_name'] : '';
                            $bcc_email = isset($site_setting['bcc_email_address']) && $site_setting['bcc_email_address'] !=null ? $site_setting['bcc_email_address'] : '';
                            $replay_email = isset($site_setting['reply_to_email']) && $site_setting['reply_to_email'] !=null ? $site_setting['reply_to_email'] : '';

                            $client_email = $value->client->email;
                            $to_email = [$client_email,$from_email];
                            $upload_path = 'storage/leadreport/'.$file_name;

                            Mail::send('mail/leadreport', ['order_data' => $value, 'file' => $file_name], function($message) use ($to_email,$from_email,$from_name,$bcc_email,$replay_email){

                                $message->from($from_email, $from_name);
                                if($bcc_email !=''){
                                    $message->bcc([$bcc_email]);
                                }
                                if($replay_email !=''){
                                    $message->replyTo($replay_email);
                                }
                                $message->to($to_email)->subject('Leads send');
                            });

                            // Update order status
                            Order::where('id', $value->id)->update(['status' => '1','file_name' => $file_name]);
                        }
                    }
                }
            }

            if(isset($lead_response) && $lead_response !=null){
                echo "Lead details send successfuly.";
                return $lead_response;
            }
        }
    }

    public static function download($path)
    {
        $path = public_path('storage/leadreport/'.$path);
        return response()->download($path);
    }
}
