<?php

namespace Database\Seeders;

use App\Models\PK;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InputPKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PK::insert([
            [
                'nama_pk' => 'PK 1',
                'harga_pk' => 15000,

            ],
            [
                'nama_pk' => 'PK 2',
                'harga_pk' => 20000,

            ],
            [
                'nama_pk' => 'PK 3',
                'harga_pk' => 25000,

            ]
        ]);
    }
}
