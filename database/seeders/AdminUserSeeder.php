<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@examp.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
            'role' => 'admin',
        ]);
    }
}

