<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    use HasFactory;

    protected $guarded = 'id';
    protected $table = 'log_login';
    protected $fillable = [
        'id_siswa',
        'nama_siswa',
        'id_guru',
        'nama_guru',
        'ip',
        // Add other fields you want to log
    ];
}
