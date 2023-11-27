<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaSesi extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswasesi';
    protected $table = 'siswa_sesi';
    protected $primaryKey = 'id_siswasesi';
}
