<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\PK;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Schema::disableForeignKeyConstraints();
        Jabatan::truncate();
        Absensi::truncate();
        PK::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $this->call([
            InputJabatanSeeder::class,
            InputPKSeeder::class,
            InputUserSeeder::class,
            InputAbsensiSeeder::class,

        ]);
    }
}
