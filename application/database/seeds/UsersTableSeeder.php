<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Alexandar Walker',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'gender' => 'Male',
            'bio' => 'Lorem ipsam',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'John Doe',
            'email' => 'doctor@admin.com',
            'password' => Hash::make('password'),
            'gender' => 'Male',
            'bio' => 'Lorem ipsam',
            'role' => 'doctor',
        ]);
        User::create([
            'name' => 'Fulton Bryant',
            'email' => 'medical@admin.com',
            'password' => Hash::make('password'),
            'gender' => 'Male',
            'bio' => 'Lorem ipsam',
            'role' => 'medical assistant',
        ]);
        User::create([
            'name' => 'Micahel Bell',
            'email' => 'pharmacist@admin.com',
            'password' => Hash::make('password'),
            'gender' => 'Male',
            'bio' => 'Lorem ipsam',
            'role' => 'pharmacist',
        ]);
    }
}
