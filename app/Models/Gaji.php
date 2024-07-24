<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';
    protected $primaryKey = 'id_gaji';

    protected $fillable = [
        'user_id',
        'total_masuk',
        'total_gaji',
        'tanggal',
        'tanggal_awal',
        'tanggal_akhir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
