<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKartu extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_kartu';
    protected $table = 'siswa_kartu';
    protected $primaryKey = 'id_siswa_kartu';
}