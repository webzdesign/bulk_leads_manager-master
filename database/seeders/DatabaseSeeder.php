<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::updateOrCreate(['email' => 'admin@gmail.com'],
        [
            'firstName' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::updateOrCreate(['email' => 'admin@apacheleads.com'],
        [
            'firstName' => 'Admin apacheleads',
            'email' => 'admin@apacheleads.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::updateOrCreate(['email' => 'admin@xsited.com'],
        [
            'firstName' => 'Admin xsited',
            'email' => 'admin@xsited.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->call(LeadTypeSeeder::class);
        $this->call(LeadFieldSeeder::class);
        $this->call(SiteSettingSeeder::class);
    }
}
