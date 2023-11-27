<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    // protected $fillable = ['nama_mapel', 'kode_mapel', 'kelas_mapel', 'jurusan_mapel'];
    // protected $table = 'mapel';
    protected $guarded = 'id_mapel';
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }


    public function gurumapel()
    {
        return $this->hasMany(Gurumapel::class, 'id_mapel', 'id_mapel');
    }
}