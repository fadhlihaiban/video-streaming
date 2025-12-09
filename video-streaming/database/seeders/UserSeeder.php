<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'adminutama2@email.com',
            'password' => Hash::make('12345678'),
            'level' => 'admin',
        ]);

        User::create([
            'name' => 'Customer Biasa',
            'email' => 'customer@email.com',
            'password' => Hash::make('12345678'),
            'level' => 'customer',
        ]);
        

        for ($i = 2; $i <= 4; $i++) {
             User::create([
                'name' => "Customer $i",
                'email' => "customer$i@email.com",
                'password' => Hash::make('12345678'),
                'level' => 'customer',
            ]);
        }
    }
}