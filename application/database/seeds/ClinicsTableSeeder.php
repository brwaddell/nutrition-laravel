<?php

namespace Database\Seeders;

use App\Clinic;
use Illuminate\Database\Seeder;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clinic::create([
            'name' => 'Midland Clinic',
            'location' => 'Midland, USA',
            'status' => 1,
        ]);

         Clinic::create([
            'name' => 'Walkland Clinic',
            'location' => 'Walkland, USA',
            'status' => 1,
         ]);

         Clinic::create([
            'name' => 'Newland Clinic',
            'location' => 'Newland, USA',
            'status' => 1,
         ]);
    }
}
