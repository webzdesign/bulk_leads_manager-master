<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Validator;
use Auth;

class SettingController extends Controller
{
    public $moduleName = 'Settings';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $moduleName = $this->moduleName;
        $site_settings = SiteSetting::get()->first();
        $email_template = EmailTemplate::get()->first();

        return view('settings/index',compact('moduleName','site_settings','email_template'));
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
            'auto_delete_rec_after' => $request['auto_delete_rec_after'],
            'disallow_import_lead_older' => $request['disallow_import_lead_older'],
            'frequency_of_deleted_archives' => $request['frequency_of_deleted_archives'],
            'no_of_time_lead_download' => $request['no_of_time_lead_download'],
            'added_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        );
        SiteSetting::updateOrCreate(['id' => $request['id']],$records);

        return back()->with('success', 'Setting updated successfuly!');
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
            'email_from_address' => ['required','email'],
            'email_from_name' => ['required'],
            'deleted_lead_email_one' => ['required','email'],
            'deleted_lead_email_two' => ['required','email'],
            'bcc_email_address' => ['nullable','sometimes','email'],
            'reply_to_email' => ['nullable','sometimes','email'],
        ], [
            'email_from_address.required' => "This Fields Is Required.",
            'email_from_address.email' => "Please Enter Valid Email Address.",

            'email_from_name.required' => "This Fields Is Required.",

            'deleted_lead_email_one.required' => "This Fields Is Required.",
            'deleted_lead_email_one.email' => "Please Enter Valid Email Address.",

            'deleted_lead_email_two.required' => "This Fields Is Required.",
            'deleted_lead_email_two.email' => "Please Enter Valid Email Address.",

            'bcc_email_address.email' => "Please Enter Valid Email Address.",
            'reply_to_email.email' => "Please Enter Valid Email Address.",
        ]);

        $records = array(
            'email_from_address' => $request['email_from_address'],
            'email_from_name' => $request['email_from_name'],
            'deleted_lead_email_one' => $request['deleted_lead_email_one'],
            'deleted_lead_email_two' => $request['deleted_lead_email_two'],
            'bcc_email_address' => $request['bcc_email_address'],
            'reply_to_email' => $request['reply_to_email'],
            'added_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        );

        SiteSetting::updateOrCreate(['id' => $request['id']],$records);

        return back()->with('success', 'Setting updated successfuly!');
    }

    /**
     * Create a email template.
     *
     * @param  array  $data
     * @return \App\Models\SiteSetting
     */
    protected function email_template_create(Request $request)
    {
        $validation = $request->validate([
            'email_subject' => ['required'],
            'content' => ['required'],
            'subject' => ['required'],
        ], [
            'email_subject.required' => "This Fields Is Required.",
            'content.required' => "This Fields Is Required.",
            'subject.required' => "This Fields Is Required.",
        ]);

        $records = array(
            'email_subject' => $request['email_subject'],
            'content' => $request['content'],
            'subject' => $request['subject'],
            'added_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        );

        EmailTemplate::updateOrCreate(['email_subject' => $request['email_subject']],$records);

        return back()->with('success', 'Setting updated successfuly!');
    }

    function get_email_template(Request $request){
        $response_array = ['status' => false,'content' => null];

        $email_template = EmailTemplate::where('email_subject',$request->email_subject)->first();
        if(isset($email_template) && $email_template !=null){
            $response_array = ['status' => true,'content' => $email_template->content, 'subject' => $email_template->subject];
        }

        return response()->json($response_array);
    }
}
