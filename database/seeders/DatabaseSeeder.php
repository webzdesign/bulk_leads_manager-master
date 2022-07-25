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
            'lastName'  => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::updateOrCreate(['email' => 'admin@apacheleads.com'],
        [
            'firstName' => 'Admin apacheleads',
            'lastName'  => 'Admin',
            'email' => 'admin@apacheleads.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::updateOrCreate(['email' => 'admin@xsited.com'],
        [
            'firstName' => 'Admin xsited',
            'lastName'  => 'Admin',
            'email' => 'admin@xsited.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::updateOrCreate(['email' => 'shivendrasinhj.ap@gmail.com'],
        [
            'firstName' => 'Admin shivendrasinhj',
            'lastName'  => 'Admin',
            'email' => 'shivendrasinhj.ap@gmail.com',
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
