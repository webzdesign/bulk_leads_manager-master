<?php

namespace Database\Seeders;

use App\Models\LeadFields;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_fields')->truncate();

        LeadFields::updateOrCreate(
        ['id' => 1, 'name' => 'First Name' ,'columnName' => 'first_name']);

        LeadFields::firstOrCreate(
        ['id' => 2, 'name' => 'Last Name' ,'columnName' => 'last_name']);

        LeadFields::firstOrCreate(
        ['id' => 3, 'name' => 'Email Address' ,'columnName' => 'email']);

        LeadFields::firstOrCreate(
        ['id' => 4, 'name' => 'Address' ,'columnName' => 'address']);

        LeadFields::firstOrCreate(
        ['id' => 5, 'name' => 'City' ,'columnName' => 'city_id' ]);

        LeadFields::firstOrCreate(
        ['id' => 6, 'name' => 'State' ,'columnName' => 'state_id']);

        LeadFields::firstOrCreate(
        ['id' => 7, 'name' => 'Country' ,'columnName' => 'country_id']);

        LeadFields::firstOrCreate(
        ['id' => 8, 'name' => 'Phone Number' ,'columnName' => 'phone_number']);

        LeadFields::firstOrCreate(
        ['id' => 9, 'name' => 'DOB','columnName' => 'birth_date']);

        LeadFields::firstOrCreate(
        ['id' => 10, 'name' => 'ZIP' ,'columnName' => 'zip']);

        LeadFields::firstOrCreate(
        ['id' => 11, 'name' => 'Gender' ,'columnName' => 'gender' ]);

        LeadFields::firstOrCreate(
        ['id' => 12, 'name' => 'Date Generated' ,'columnName' => 'date_generated' ]);

    }
}
