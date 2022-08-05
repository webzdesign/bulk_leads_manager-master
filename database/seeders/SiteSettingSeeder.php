<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = array(
            'auto_delete_rec_after' => 12,
            'disallow_import_lead_older' => 12,
            'frequency_of_deleted_archives' => 1,
            'no_of_time_lead_download' => 1,
            'email_from_address' => 'developer@gmail.com',
            'email_from_name' => 'Developer',
            'deleted_lead_email_one' => 'developer@gmail.com',
            'deleted_lead_email_two' => 'developer@gmail.com',
            'bcc_email_address' => NULL,
            'reply_to_email' => NULL,
            'added_by' => 1,
        );
        SiteSetting::updateOrCreate(['id' => 1],$records);

        $records = array(
            'email_subject' => 'lead-delete',
            'content' => 'Delete Lead',
            'added_by' => 1,
        );
        EmailTemplate::updateOrCreate(['id' => 1],$records);

        $records = array(
            'email_subject' => 'lead-send',
            'content' => 'Send Lead',
            'added_by' => 1,
        );
        EmailTemplate::updateOrCreate(['id' => 2],$records);
    }
}
