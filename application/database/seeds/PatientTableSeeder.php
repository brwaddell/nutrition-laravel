<?php

namespace Database\Seeders;

use App\Patient;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'first_name' => 'Louis',
            'last_name' => 'Battle',
            'email' => 'dyhon@mailinator.com',
            'dob'=> '2002-01-16',
            'conditions'=>'Aliqua Elit volupt',
            'image'=>'1623743650logo',
            'clinic_id'=>1,
            'status'=>1
        ]);
    }
}
