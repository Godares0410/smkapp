<?php

namespace App\Imports;

use App\Models\Mapel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MapelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Mapel([
            'nama_mapel' => $row['nama_mapel'],
            'kode_mapel' => $row['kode_mapel'],
            'kelas_mapel' => $row['kelas_mapel'],
            'jurusan_mapel' => $row['jurusan_mapel'],
        ]);
    }
}
