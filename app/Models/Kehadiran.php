<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';

    protected $primaryKey = 'id_kehadiran';

    protected $fillable = [
        'id_user',
        'jam_masuk',
        'jam_pulang',
        'id_pk',
        'id_absensi',
        'jumlah_pk',
        'pk_selesai',
        'pk_belum',
        'status',
        'tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pk()
    {
        return $this->belongsTo(PK::class, 'id_pk');
    }
}
