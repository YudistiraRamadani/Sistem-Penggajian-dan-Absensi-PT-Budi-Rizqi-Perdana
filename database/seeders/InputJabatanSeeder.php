<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InputJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::insert([
            ['nama_jabatan' => 'Pegawai Lapangan'],
            ['nama_jabatan' => 'Pelaksana'],
            ['nama_jabatan' => 'Direktur'],
            ['nama_jabatan' => 'Admin'],
        ]);
    }
}
