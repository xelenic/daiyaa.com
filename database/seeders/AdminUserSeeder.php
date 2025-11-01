<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@daiyaa.lk',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'phone' => '+94 55 223 4567',
            'address' => 'Main Street',
            'city' => 'Wellawaya',
            'postal_code' => '91200',
        ]);

        // Create a test customer
        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@test.com',
            'password' => Hash::make('customer123'),
            'is_admin' => false,
            'phone' => '+94 77 123 4567',
            'address' => '123 Test Street',
            'city' => 'Wellawaya',
            'postal_code' => '91200',
        ]);
    }
}

