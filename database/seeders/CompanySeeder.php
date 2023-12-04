<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            'name'=> "Company A",
            'address'=> "Jl. Simatupang no.50 Semarang",
            "email" => "company_a@mail.co"
        ]);

        DB::table('company')->insert([
            'name'=> "Company B",
            'address'=> "Jl. Simatupang no.20 Semarang"
        ]);
    }
}
