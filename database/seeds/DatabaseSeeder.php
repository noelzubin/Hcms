<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //hospitals
        DB::connection("centraldb")->table('Hospitals')->insert([
            'id' => 1,
            'name' => "Lourdes, Pachalam"
        ]);
        DB::connection("centraldb")->table('Hospitals')->insert([
            'id' => 2,
            'name' => "Aster, Chittoor"
        ]);


        // diagnostics
        DB::table('diagnostics')->insert([
            'id' => 1,
            'password' => bcrypt("password")
        ]);

        //receptions
        DB::table('receptions')->insert([
            'id' => 1,
            'password' => bcrypt("password"),
            'hospital' => 2
        ]);

        //pharmacies
        DB::table('pharmacies')->insert([
            'id' => 1,
            'password' => bcrypt("password")
        ]);

    }
}
