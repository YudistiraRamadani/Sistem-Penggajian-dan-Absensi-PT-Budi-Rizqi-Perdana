<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InputUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'role' => 'admin',
                'id_jabatan' => 4,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123')
            ], [
                'role' => 'user',
                'id_jabatan' => 1,
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123')
            ]
        ]);
    }
}
