<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    private $moduleName = "Orders";
    private $view = "orders";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view("$this->view/index", compact('moduleName'));
    }
}
