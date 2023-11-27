<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Guru extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;

    protected $guarded = 'id_guru';
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';

    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class);
    // }

    // public function jurusan()
    // {
    //     return $this->belongsTo(Jurusan::class);
    // }
    public function gurumapel()
    {
        return $this->hasMany(Gurumapel::class, 'id_guru', 'id_guru');
    }
}
