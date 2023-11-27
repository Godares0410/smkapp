<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaMulai extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_mulai';
    protected $table = 'siswa_mulai';
    protected $primaryKey = 'id_siswa_mulai';
}
