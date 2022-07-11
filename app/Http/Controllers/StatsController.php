<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
    //
    private $moduleName = "Stats";
    private $view = "stats";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view("$this->view/index", compact('moduleName'));
    }
}
