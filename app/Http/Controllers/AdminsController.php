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
                    $actions .= "<a href='' class='btn btn-info editBtn btn-lg' data-id='".$row->id."'><i class='fa fa-pencil'></i>  </a>";
                    $actions .= "<a href='' class='btn btn-danger deleteBtn btn-lg delete_record' data-id='".$row->id."'><i class='fa fa-trash'></i>  </a>";
                    return $actions;
                })
                ->rawColumns(['action'])
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
        dd($validate);
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
        if($request->type == 'UPDATE')
        {
            $user = User::where('email',$request->email)->where('id','!=',$request->id)->get()->count();
        }
        else
        {
            $user = User::where('email', 'like', '%' . $request->email . '%')->get()->count();
        }

       if($user > 0)
       {
        return response()->json(false);
       }
       else
       {
        return response()->json(true);
       }

    }

}
