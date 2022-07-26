<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\LeadType;
use App\Models\AgeGroup;
use App\Models\State;
use App\Models\OrderDetail;
use App\Exports\LeadDetailsExport;
use Maatwebsite\Excel\Facades\Excel;
use DB,DataTables,Mail,Storage;

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
        $orders = Order::with(['client','lead_type','age_group'])->select('*');

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
                return '--';
            })
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $actions = '';
                $actions .= '<div class="editDlbtn d-flex">
                    <a href="javascript:;">
                        <button class="cartBtn w-auto px-3 text-white f-500">
                            <svg class="me-2" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.8334 11.9999C11.0934 11.9999 10.5001 12.5933 10.5001 13.3333C10.5001 13.6869 10.6406 14.026 10.8906 14.2761C11.1407 14.5261 11.4798 14.6666 11.8334 14.6666C12.187 14.6666 12.5262 14.5261 12.7762 14.2761C13.0263 14.026 13.1667 13.6869 13.1667 13.3333C13.1667 12.5933 12.5667 11.9999 11.8334 11.9999ZM1.16675 1.33325V2.66659H2.50008L4.90008 7.72659L3.99341 9.35992C3.89341 9.54659 3.83341 9.76659 3.83341 9.99992C3.83341 10.3535 3.97389 10.6927 4.22394 10.9427C4.47399 11.1928 4.81313 11.3333 5.16675 11.3333H13.1667V9.99992H5.44675C5.40254 9.99992 5.36015 9.98236 5.3289 9.9511C5.29764 9.91985 5.28008 9.87745 5.28008 9.83325C5.28008 9.79992 5.28675 9.77325 5.30008 9.75325L5.90008 8.66659H10.8667C11.3667 8.66659 11.8067 8.38659 12.0334 7.97992L14.4201 3.66659C14.4667 3.55992 14.5001 3.44659 14.5001 3.33325C14.5001 3.15644 14.4298 2.98687 14.3048 2.86185C14.1798 2.73682 14.0102 2.66659 13.8334 2.66659H3.97341L3.34675 1.33325H1.16675ZM5.16675 11.9999C4.42675 11.9999 3.83341 12.5933 3.83341 13.3333C3.83341 13.6869 3.97389 14.026 4.22394 14.2761C4.47399 14.5261 4.81313 14.6666 5.16675 14.6666C5.52037 14.6666 5.85951 14.5261 6.10956 14.2761C6.3596 14.026 6.50008 13.6869 6.50008 13.3333C6.50008 12.5933 5.90008 11.9999 5.16675 11.9999Z" fill="white"/>
                            </svg>
                            Resend Order
                        </button>
                    </a>
                </div>';
                return $actions;
        })
        ->rawColumns(['first_name','last_name','email','order_date','last_product_ordered','action'])
        ->make(true);

        return $datatable;
    }

    public function sendLead(){

        $order_data = Order::with(['client'])->where('status','0')->get();
        $lead_response = [];

        if(!$order_data->isEmpty()){

            foreach($order_data as $key => $value){
                $lead_collection = [];

                $lead_ids = Lead::where(['lead_type_id' => $value->lead_type_id,'age_group_id' => $value->age_group_id])->pluck('id')->toArray();

                if(isset($lead_ids) && $lead_ids !=null){
                    $skip_lead_details_ids = OrderDetail::where(['order_id' => $value->id])->pluck('lead_details_id')->toArray();
                    $lead_details = LeadDetail::with(['lead.age_group','country','state','city'])->whereIn('lead_id',$lead_ids)->where('is_duplicate',0)->take($value->qty);

                    if(isset($skip_lead_details_ids) && $skip_lead_details_ids !=null){
                        $lead_details->whereNotIn('id',$skip_lead_details_ids);
                    }
                    $lead_details = $lead_details->get();

                    if(isset($lead_details) && $lead_details !=null){
                        foreach ($lead_details as $key => $row) {

                            // Update order status
                            // Order::where('id', $value->id)->update(['status' => '1']);

                            $lead_collection[] = array(
                                'age_group' => $row->lead->age_group->age_from.' - '.$row->lead->age_group->age_to,
                                'first_name' => $row->first_name,
                                'last_name' => $row->last_name,
                                'gender' => $row->gender == 0 ? 'Male' : ($row->gender == 1 ? 'Female' : ''),
                                'email' => $row->email,
                                'address' => $row->address,
                                'country' => $row->country->name,
                                'state' => $row->state->name,
                                'city' => $row->city->name,
                                'phone_number' => $row->phone_number,
                                'birth_date' => $row->birth_date,
                                'age' => isset($row->age) && $row->age !=null ? $row->age : 'N/A',
                                'zip' => isset($row->zip) && $row->zip !=null ? $row->zip : 'N/A',
                            );

                            //Add records
                            $where_array = ['order_id' => $value->id, 'lead_details_id' => $row->id];
                            // OrderDetail::updateOrCreate($where_array,['order_id' => $value->id, 'lead_details_id' => $row->id]);
                        }

                        if(isset($lead_collection) && $lead_collection !=null){

                            $file_name = 'LeadReport-'.uniqid().'.xlsx';
                            $lead_response = Excel::store(new LeadDetailsExport($lead_collection), $file_name, 'leadreport'); //Third parameter is storage path if check path to config/filesystem.php

                            //Mail sending
                            $to_email = $value->client->email;
                            $upload_path = 'storage/leadreport/'.$file_name;

                            Mail::send('mail/leadreport', [], function($message) use ($to_email,$upload_path){
                                $message->to($to_email)->subject('Lead reports');
                                $message->attach(public_path($upload_path));
                            });
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
}
