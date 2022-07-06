<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public $moduleName = 'Settings';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $moduleName = $this->moduleName;

        return view('settings',compact('moduleName'));
    }

    /**
     * Create a site settings.
     *
     * @param  array  $data
     * @return \App\Models\SiteSetting
     */
    protected function site_setting_create(Request $request)
    {
        $validation = $request->validate([
            'auto_delete_rec_after' => ['required'],
            'disallow_import_lead_older' => ['required'],
            'frequency_of_deleted_archives' => ['required'],
            'no_of_time_lead_download' => ['required'],
        ], [
            'auto_delete_rec_after.required' => "This Fields Is Required.",
            'disallow_import_lead_older.required' => "This Fields Is Required.",
            'frequency_of_deleted_archives.required' => "This Fields Is Required.",
            'no_of_time_lead_download.required' => "This Fields Is Required.",
        ]);

        $records = array(
            'auto_delete_rec_after' => $request['name'],
            'disallow_import_lead_older' => $request['name'],
            'frequency_of_deleted_archives' => $request['name'],
            'no_of_time_lead_download' => $request['name'],
        );
        SiteSetting::updateOrCreate($request['id'],$records);

        return back();
    }

    /**
     * Create a email setup.
     *
     * @param  array  $data
     * @return \App\Models\SiteSetting
     */
    protected function email_setup_create(Request $request)
    {
        $validation = $request->validate([
            'email_from_address' => ['required'],
            'deleted_lead_email_one' => ['required'],
            'deleted_lead_email_two' => ['required'],
            'bcc_email_address' => ['email'],
            'reply_to_email' => ['email'],
        ], [
            'email_from_address.required' => "This Fields Is Required.",
            'deleted_lead_email_one.required' => "This Fields Is Required.",
            'deleted_lead_email_two.required' => "This Fields Is Required.",
            'bcc_email_address.email' => "Please Enter Valid Email Address.",
            'reply_to_email.email' => "Please Enter Valid Email Address.",
        ]);

        SiteSetting::create([
            'auto_delete_rec_after' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
