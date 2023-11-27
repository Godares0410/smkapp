<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaNilai extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_nilai';
    protected $table = 'siswa_nilai';
    protected $primaryKey = 'id_siswa_nilai';
}
