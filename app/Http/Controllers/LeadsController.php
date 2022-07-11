<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadsController extends Controller
{
    //
    private $moduleName = "Leads";
    private $view = "leads";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view("$this->view/index", compact('moduleName'));
    }
}
