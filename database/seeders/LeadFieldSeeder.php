<?php

namespace Database\Seeders;

use App\Models\LeadFields;
use Illuminate\Database\Seeder;

class LeadFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadFields::updateOrCreate(
        ['id' => 1, 'name' => 'First Name']);

        LeadFields::firstOrCreate(
        ['id' => 2, 'name' => 'Last Name']);

        LeadFields::firstOrCreate(
        ['id' => 3, 'name' => 'Email Address']);

        LeadFields::firstOrCreate(
        ['id' => 4, 'name' => 'Address']);

        LeadFields::firstOrCreate(
        ['id' => 5, 'name' => 'City']);

        LeadFields::firstOrCreate(
        ['id' => 6, 'name' => 'State']);

        LeadFields::firstOrCreate(
        ['id' => 7, 'name' => 'Country']);

        LeadFields::firstOrCreate(
        ['id' => 8, 'name' => 'Phone Number']);

        LeadFields::firstOrCreate(
        ['id' => 9, 'name' => 'DOB']);

        LeadFields::firstOrCreate(
        ['id' => 10, 'name' => 'ZIP']);

        LeadFields::firstOrCreate(
        ['id' => 11, 'name' => 'Gender']);

    }
}
