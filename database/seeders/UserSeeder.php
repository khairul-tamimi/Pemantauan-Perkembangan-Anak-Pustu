<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // cek kalau sudah ada, jangan dobel
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'), // ganti dengan password aman
                'role' => 'admin',
            ]
        );
    }
}
