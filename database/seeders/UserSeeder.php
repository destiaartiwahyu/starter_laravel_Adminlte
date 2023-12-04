<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'email'=> "admin@admin.com",
            'password'=> bcrypt("password"),
            'role' => "admin",
            'name' => "admin"
        ]);
        \App\Models\User::create([
            'name'=>"user nih boss",
            'email'=> "user@user.com",
            'password'=> bcrypt("password")
        ]);
    }
}
