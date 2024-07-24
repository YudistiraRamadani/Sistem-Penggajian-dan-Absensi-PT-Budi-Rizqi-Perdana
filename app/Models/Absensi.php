<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'judul_absensi',
        'deskripsi_absensi',
        'jam_masuk',
        'jam_pulang',
        'batas_jam_masuk',
        'batas_jam_pulang',
        'code_absensi'

    ];
}
