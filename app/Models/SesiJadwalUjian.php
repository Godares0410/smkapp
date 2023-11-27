<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiJadwalUjian extends Model
{
    protected $table = 'sesi_jadwal_ujian';

    // Sesuaikan atribut-atribut yang diperlukan
    protected $fillable = [
        'id_jadwal_ujian',
        'sesi',
        'jam_mulai',
        'jam_selesai',
    ];
}
