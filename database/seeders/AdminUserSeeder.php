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
            'name' => 'Super Admin',
            'username' => 'Admin',
            'email' => 'admin@examp.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
        ]);

        User::updateOrCreate([
            'name' => 'Guru',
            'username' => 'guru',
            'email' => 'guru@examp.com',
            'role' => 'guru',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
        ]);

        User::updateOrCreate([
            'name' => 'Dudi',
            'username' => 'dudi',
            'email' => 'dudi@examp.com',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
            'role' => 'dudi',
        ]);

        User::updateOrCreate([
            'name' => 'Murid',
            'username' => 'murid',
            'email' => 'murid@examp.com',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
            'role' => 'siswa',
        ]);
    }
}

