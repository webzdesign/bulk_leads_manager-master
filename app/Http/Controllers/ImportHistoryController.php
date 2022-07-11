<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportHistoryController extends Controller
{
    //
    private $moduleName = "Import History";
    private $view = "importHistory";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view("$this->view/index", compact('moduleName'));
    }
}
