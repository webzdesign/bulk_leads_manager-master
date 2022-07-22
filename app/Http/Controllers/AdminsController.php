<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminsController extends Controller
{
    private $moduleName = "Admins";
    private $view = "admins";


    public function index()
    {
        $moduleName = $this->moduleName;
        $users = User::where('id','!=',1)->get();
        return view($this->view.'/index',compact('moduleName','users'));
    }

    public function getData()
    {
        $user = User::where('id','!=',1)->select('*');
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
                ->addColumn('lastlogin',function($row){
                    $lastlogin = '';
                    return $lastlogin;
                })
                ->editColumn('created_at',function($row){
                    return date('d/m/y',strtotime($row->created_at));
                })
                ->rawColumns(['action','lastlogin','created_at'])
                ->make(true);
    }

    public function store(Request $request)
    {
        $moduleName = $this->moduleName;
        if(isset($request->type) && $request->type == "UPDATE")
        {
            $validate =  $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:users,email,'.$request->id,
                'password' => 'sometimes|nullable',
                'password_confirmation' => 'sometimes|nullable|same:password'
            ]);

            $user = User::where('id',$request->id)->first();

            $password = $request->password ? $request->password : $user->password;

            $user = User::find($request->id)->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'allowCreateEditUser' => $request->allow,
                'password' =>$password,
            ]);
            $message = $moduleName." Updated Successfully.";
        }
        else
        {
           $validate = $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'password_confirmation' => 'required|same:password'
            ]);

            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'allowCreateEditUser' => $request->allow,
                'added_by' => auth()->user()->id,
                ]);
                $message = $moduleName." Added Successfully.";
        }
        return response()->json([true,$moduleName,$message]);
    }

    public function edit(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        if($user) {
            return response()->json($user);
        }
        else
        {
            return response()->json(false);
        }
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        $message = $this->moduleName." Deleted Successfully.";
        return response()->json([true,$message]);
    }

    public function checkEmailId(Request $request)
    {
        // dd($request->all());

        if($request->type == 'UPDATE')
        {
            $user = User::where('email', 'like', '%' . $request->email . '%')->where('id','!=',$request->id)->get()->count();
        }
        else
        {
            $user = User::where('email', 'like', '%' . $request->email . '%')->get()->count();
        }
        return response()->json($user);

    }

}
