<?php

namespace Database\Seeders;

use App\Models\LeadType;
use Illuminate\Database\Seeder;

class LeadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadType::updateOrCreate(['name' => 'Australian Bulk Leads'],[
            'name'     => 'Australian Bulk Leads',
            'added_by' => 1
        ]);

        LeadType::updateOrCreate(['name' => 'US Bulk Leads'],[
            'name'     => 'US Bulk Leads',
            'added_by' => 1
        ]);
    }
}
