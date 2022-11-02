<?php

namespace Database\Seeders;

use App\PublicHealthForm;
use Illuminate\Database\Seeder;

class PublicHealthFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PublicHealthForm::create([
            'name' => 'INTERMITTENT HEALTH FORM',
        ]);

        PublicHealthForm::create([
            'name' => 'MATERNAL HEALTH QUESTIONAIRRE',
        ]);

        PublicHealthForm::create([
            'name' => 'PARENTAL HISTORY QUESTIONNAIRE',
        ]);

        PublicHealthForm::create([
            'name' => 'AGRICULTURAL QUESTIONNAIRE',
        ]);
    }
}
