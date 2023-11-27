<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\GuruMapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GuruMapelController extends Controller
{
    public function index()
    {
        
        $guru = Guru::all();
        $mapel = Mapel::all();
        return view('data_umum.guru_mapel.index', compact('guru', 'mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_mapel' => 'required',
        ]);
        $mapel = new GuruMapel;
        $mapel->id_guru = $request->id_guru;
        $mapel->id_mapel = $request->id_mapel;
        $mapel->save();

        // Tampilkan pesan success
        return redirect()->route('guru_mapel.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function destroy($mapel_id)
    {
        $deleted = GuruMapel::where('id_mapel', $mapel_id)->delete();

        if ($deleted) {
            return redirect()->route('guru_mapel.index')
                ->with('success', 'Data mata pelajaran berhasil dihapus.');
        }

        return redirect()->route('guru_mapel.index')
            ->with('error', 'Gagal menghapus data mata pelajaran.');
    }
}
