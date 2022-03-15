<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(
            ['name'=>'Admin', 'email'=>'admin@admin.com', 'password'=>bcrypt('adminpanel12345'), 'email_verified_at'=>now(), 'utype'=> 'ADM']
        );
    }
}
