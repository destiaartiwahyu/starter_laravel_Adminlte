<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'first_nm'=> "fabio",
            'last_nm'=> "Asher", 
            'email' => "ms_a@mail.co",
            'phone' => "08929298",
            'company_id' => 1
        ]);

        DB::table('employees')->insert([
            'first_nm'=> "Rumah",
            'last_nm'=> "Singgah", 
            'email' => "rumah_singgah@mail.co",
            'phone' => "089292982",
            'company_id' => 1
        ]);
        DB::table('employees')->insert([
            'first_nm'=> "shawn",
            'last_nm'=> "mendes", 
            'email' => "shawna@mail.co",
            'phone' => "0892923398",
            'company_id' => 2
        ]);
    }
}
