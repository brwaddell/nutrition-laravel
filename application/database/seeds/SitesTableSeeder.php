<?php

namespace Database\Seeders;

use App\Site;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'title' => 'Childhood Nutrition',
            'footer_copyright' => 'Childhood Nutrition',
            'image1' => '1623848622logo.png',
            'image2' => '1623848622logo.png',
            'image3' => '1623848622logo.png',
        ]);
    }
}
