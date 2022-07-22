<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Client;
use App\Models\LeadType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    private $moduleName = "Clients";
    private $view = "clients";

    public function index()
    {
        $moduleName = $this->moduleName;
        $clients = Client::all();
        $states = Client::all()->unique('state')->pluck('state');
        return view($this->view.'/index',compact('moduleName','clients','states'));
    }

    public function getData(Request $request)
    {
        $user = Client::select('*');
        if($request->state)
        {
            $user->where('state',$request->state)->select('*');
        }
        $data =$user;
        return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actions = '';
                    $actions .= ' <a href="javascript:;">
                    <button class="editBtn" data-id="'.$row->id.'">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.8067 4.69354C14.0667 4.43354 14.0667 4.0002 13.8067 3.75354L12.2467 2.19354C12 1.93354 11.5667 1.93354 11.3067 2.19354L10.08 3.41354L12.58 5.91354L13.8067 4.69354ZM2 11.5002V14.0002H4.5L11.8733 6.6202L9.37333 4.1202L2 11.5002Z"
                                fill="white" />
                        </svg>
                    </button>
                </a>';
                    $actions .= '<button class="deleteBtn delete_record" data-id="'.$row->id.'">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.6666 2.66667H10.3333L9.66659 2H6.33325L5.66659 2.66667H3.33325V4H12.6666V2.66667ZM3.99992 12.6667C3.99992 13.0203 4.14039 13.3594 4.39044 13.6095C4.64049 13.8595 4.97963 14 5.33325 14H10.6666C11.0202 14 11.3593 13.8595 11.6094 13.6095C11.8594 13.3594 11.9999 13.0203 11.9999 12.6667V4.66667H3.99992V12.6667Z"
                            fill="white" />
                    </svg>
                </button>';
                    return $actions;
                })
                ->addColumn('lastOrderDate',function($row){
                    $lastOrderDate = '';
                    return $lastOrderDate;
                })
                ->addColumn('lastProductOrder',function($row){
                    $lastProductOrder = '';
                    return $lastProductOrder;
                })
                ->editColumn('created_at',function($row){
                    return date('d/m/y',strtotime($row->created_at));
                })
                ->rawColumns(['action','lastOrderDate','lastProductOrder','created_at'])
                ->make(true);
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

            $checkemail = Client::where('email', $request->email)->where('id','!=',$request->id)->count();
            if($checkemail > 0)
            {
                return false;
            }
            else
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


        }
        else
        {
            $checkemail = Client::where('email', $request->email)->count();
            if($checkemail > 0)
            {
                return (false);
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
        $clients = Client::all();
        return response()->json([true,$message]);
    }

    public function checkEmailId(Request $request)
    {
        if($request->type == "UPDATE") {
            $checkemail = Client::where('email', $request->email)->where('id','!=',$request->id)->count();
        } else {
            $checkemail = Client::where('email', $request->email)->count();
        }

        echo json_encode($checkemail);

    }

}
