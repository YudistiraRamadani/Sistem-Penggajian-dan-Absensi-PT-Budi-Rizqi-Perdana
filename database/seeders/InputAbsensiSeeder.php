<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputAbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('absensi')->insert([
            [
                'judul_absensi' => 'Absensi Bulan Juli Minggu Pertama',
                'deskripsi_absensi' => 'absensi minggu pertama',
                'jam_masuk' => '07:00:00',
                'jam_pulang' => '07:50:00',
                'batas_jam_masuk' => '17:00:00',
                'batas_jam_pulang' => '17:00:00',
                'code_absensi' => null,
                'created_at' => Carbon::parse('2024-07-23 02:51:11'),
                'updated_at' => Carbon::parse('2024-07-23 02:51:11'),
            ],
            [
                'judul_absensi' => 'Absensi Bulan Juli Minggu Kedua',
                'deskripsi_absensi' => 'minggu ke dua',
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '08:00:00',
                'batas_jam_masuk' => '19:00:00',
                'batas_jam_pulang' => '21:00:00',
                'code_absensi' => null,
                'created_at' => Carbon::parse('2024-07-23 08:12:03'),
                'updated_at' => Carbon::parse('2024-07-23 08:12:03'),
            ],
            [
                'judul_absensi' => 'Absensi Bulan Juli Minggu Ketiga',
                'deskripsi_absensi' => 'absensi minggu ketiga',
                'jam_masuk' => '07:00:00',
                'jam_pulang' => '17:00:00',
                'batas_jam_masuk' => '12:00:00',
                'batas_jam_pulang' => '18:00:00',
                'code_absensi' => null,
                'created_at' => Carbon::parse('2024-07-24 09:27:41'),
                'updated_at' => Carbon::parse('2024-07-24 09:27:41'),
            ],
        ]);
    }
}
