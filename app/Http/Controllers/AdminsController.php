<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    private $moduleName = "Admins";
    private $view = "admins";


    public function index()
    {
        $moduleName = $this->moduleName;
        $users = User::all();
        return view($this->view.'/index',compact('moduleName','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password,
            'added_by' => auth()->user()->id,
            ]);

           self::index();
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

    public function update(Request $request)
    {
        $request->validate([
            'up_firstName' => 'required',
            'up_lastName' => 'required',
            'up_email' => 'required|email',
            'up_password' => 'sometimes|confirmed',
        ]);

        $user = User::where('id',$request->id)->first();

        $password = $request->up_password ? $request->up_password : $user->password;
        $confirmPassword = $password;

        $user = User::find($request->id)->update([
            'firstName' => $request->up_firstName,
            'lastName' => $request->up_lastName,
            'email' => $request->up_email,
            'password' =>$password,
        ]);

        return back();
    }
}
