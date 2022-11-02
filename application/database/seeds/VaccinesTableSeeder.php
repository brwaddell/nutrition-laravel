<?php

namespace Database\Seeders;

use App\Vaccine;
use Illuminate\Database\Seeder;

class VaccinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vaccine::create([
            'name' => 'HPV',
            'description' => '<p>HPV<br></p>',
            'scientific_name' => 'HPV',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Flu - Seasonal',
            'description' => '<p>Flu - Seasonal<br></p>',
            'scientific_name' => 'RotaVirus',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Rotavirus',
            'description' => '',
            'scientific_name' => 'RotaVirus',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Meningococcal B',
            'description' => '',
            'scientific_name' => 'MeningococcalB',
            'status' => 1,
        ]);


        Vaccine::create([
            'name' => 'Varicella',
            'description' => '',
            'scientific_name' => 'Var',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'M-M-R-V',
            'description' => '',
            'scientific_name' => 'MMR',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Td / Tdap Booster',
            'description' => '',
            'scientific_name' => 'TdapBooster',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Hep A',
            'description' => '',
            'scientific_name' => 'HepA 2dose',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Meningococcal CY',
            'description' => '',
            'scientific_name' => 'Meningococcal CY',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Pneumococcal',
            'description' => '',
            'scientific_name' => 'PCV13',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Polio',
            'description' => '',
            'scientific_name' => 'DTap-HIB-IP',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Hib',
            'description' => '',
            'scientific_name' => 'DTap-HIB-IP',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Diph Tetanus Pertuss',
            'description' => '',
            'scientific_name' => 'DTap-HIB-IP',
            'status' => 1,
        ]);

        Vaccine::create([
            'name' => 'Hep B',
            'description' => '',
            'scientific_name' => 'DTap-HIB-IP',
            'status' => 1,
        ]);
    }
}
