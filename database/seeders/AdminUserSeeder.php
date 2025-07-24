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

        User::updateOrCreate([
            'email' => 'guru@examp.com',
        ], [
            'name' => 'Guru',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
            'role' => 'guru',
        ]);

        User::updateOrCreate([
            'email' => 'dudi@examp.com',
        ], [
            'name' => 'dudi',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
            'role' => 'dudi',
        ]);

        User::updateOrCreate([
            'email' => 'murid@examp.com',
        ], [
            'name' => 'murid',
            'password' => Hash::make('admin123'), // Ganti dengan password aman!
            'role' => 'siswa',
        ]);
    }
}

