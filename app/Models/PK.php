<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PK extends Model
{
    use HasFactory;

    protected $table = 'pk';
    protected $primaryKey = 'id_pk';

    protected $fillable = [
        'nama_pk',
        'harga_pk'
    ];
}
