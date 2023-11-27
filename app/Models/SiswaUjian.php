<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaUjian extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_ujian';
    protected $table = 'siswa_ujian';
    protected $primaryKey = 'id_siswa_ujian';
}
