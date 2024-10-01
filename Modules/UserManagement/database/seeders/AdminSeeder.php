<?php

namespace Modules\UserManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UserManagement\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([

        // ]);


        User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => "admin1234",
            'role' => "admin",
        ]);


    }
}
