<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\EmailTemplate;
use App\Models\LeadDetail;
use App\Models\SiteSetting;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use ZipArchive;

class LeadDeleteController extends Controller
{
    public static function LeadDelete()
    {
        $setting = SiteSetting::find(1);
        $emailTemplate = EmailTemplate::find(1);
        $days = $setting->auto_delete_rec_after * 30;
        $newDate = date('Y-m-d', strtotime("-$days days"));

        $leadDetails = LeadDetail::where("date_generated","<",$newDate)->get();

        if(count($leadDetails) > 0) {

            $fileName = 'Leade_Delete_'.date('m-d-Y').'.csv';
            $columnNames = [
                "FirstName",
                "LastName",
                "Email",
                "Phone Number",
                "Gender",
                "Address",
                "City",
                "State",
                "Country",
                "Birth Date",
                "Age",
                "Zip",
                "IP"
            ];

            $file = fopen('public/assets/' . $fileName, 'w');
            fputcsv($file, $columnNames);

            foreach ($leadDetails as $leadDetail) {

                if($leadDetail->gender === null) {
                    $gender = null;
                } else if ($leadDetail->gender == 1) {
                    $gender = "Female";
                } else {
                    $gender = "Male";
                }

                if($leadDetail->city_id != '') {
                    $city = City::where('id',$leadDetail->city_id)->first()->name;
                } else {
                    $city = null;
                }
                if($leadDetail->state_id != '') {
                    $state = State::where('id',$leadDetail->state_id)->first()->name;
                } else {
                    $state = null;
                }
                if($leadDetail->country_id) {
                    $country = Country::where('id',$leadDetail->country_id)->first()->name;
                } else {
                    $country = null;
                }

                fputcsv($file, [
                    $leadDetail->first_name,
                    $leadDetail->last_name,
                    $leadDetail->email,
                    $leadDetail->phone_number,
                    $gender,
                    $leadDetail->address,
                    $city,
                    $state,
                    $country,
                    $leadDetail->birth_date,
                    $leadDetail->age,
                    $leadDetail->zip,
                    $leadDetail->ip
                ]);
            }

            fclose($file);

            LeadDetail::where("date_generated","<",$newDate)->delete();

            echo "Record Deleted Successfully.\n";

            $public_dir = public_path();
            $newName = explode('.csv',$fileName);
            $zipFileName = $newName[0].'.zip';
            $zip = new ZipArchive;
            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->addFile(public_path('assets/'.$fileName),$fileName);
                $zip->close();
            }

            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );

            $filetopath = $public_dir.'/'.$zipFileName;

            if(isset($setting->deleted_lead_email_one)) {
                $data["email"] = $setting->deleted_lead_email_one;
                $data["title"] = "Bulk Leads Manager";
                $data["body"] = $emailTemplate->content;

                $files = [ $filetopath ];

                Mail::send('leadDeleteMail', $data, function($message)use($data, $files) {
                    $message->to($data["email"], $data["email"])->subject($data["title"]);

                    foreach ($files as $file) {
                        $message->attach($file);
                    }

                });
            }

            if(isset($setting->deleted_lead_email_two)) {
                $data["email"] = $setting->deleted_lead_email_two;
                $data["title"] = "Bulk Leads Manager";
                $data["body"] = $emailTemplate->content;

                $files = [ $filetopath ];

                Mail::send('leadDeleteMail', $data, function($message)use($data, $files) {
                    $message->to($data["email"], $data["email"])->subject($data["title"]);

                    foreach ($files as $file) {
                        $message->attach($file);
                    }

                });
            }

            echo ('Mail sent successfully.\n');

            if (File::exists(public_path('assets/'.$fileName))) {
                unlink(public_path('assets/'.$fileName));
            }

            if (File::exists($filetopath)) {
                unlink($filetopath);
            }

        } else {
            echo "No Record Founds.\n";
        }

    }
}
