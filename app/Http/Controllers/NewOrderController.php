<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewOrderController extends Controller
{
    public $moduleName = 'New order';

    public function index(){
        $moduleName = $this->moduleName;

        return view('new_order/index',compact('moduleName'));
    }

    public function add_client(Request $request){

        dd($request->all());
    }
}
