<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnals';

    protected $fillable = [
        'nama',
        'kelas',
        'keperluan',
        'judul_buku',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
