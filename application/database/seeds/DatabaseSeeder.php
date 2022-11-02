<?php

use Database\Seeders\ClinicsTableSeeder;
use Database\Seeders\PatientTableSeeder;
use Database\Seeders\PublicHealthFormsTableSeeder;
use Database\Seeders\SitesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\VaccinesTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
        //  $this->call(PatientTableSeeder::class);
        $this->call(ClinicsTableSeeder::class);
        $this->call(SitesTableSeeder::class);
        $this->call(VaccinesTableSeeder::class);
        $this->call(PublicHealthFormsTableSeeder::class);
    }
}
