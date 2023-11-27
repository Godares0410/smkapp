<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jurusan;
use App\Imports\MapelImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        // // Sample query to get id_jurusan values from the Mapel table
        // $idJurusanValues = Mapel::pluck('id_jurusan')->toArray();

        // // Decode the JSON-encoded string to get an array of id_jurusan values
        // $decodedIdJurusanValues = array_map('intval', json_decode($idJurusanValues[0], true));

        // // Query the Jurusan table to get the id_jurusan and kode_jurusan values for the provided kode_jurusan values
        // $result = Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
        //     ->get();
        // Use compact to pass the result to the view
        return view('data_umum.mapel.index', compact('mapel', 'kelas', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required',
            // 'nama_kelas' => 'required',
        ]);

        $jurusan = json_encode($request->jurusan_mapel);

        $mapel = new Mapel;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->id_mapel = $request->id_mapel;
        $mapel->id_kelas = $request->kelas;
        $mapel->id_jurusan = $jurusan;
        $mapel->save();

        return redirect()->back()->with('success', 'Mapel berhasil ditambahkan');
    }



    public function import(Request $request)
    {
        // Validasi file Excel
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil file yang diupload
        $file = $request->file('file');

        // Baca file Excel
        $data = \Excel::toArray([], $file);

        // Loop melalui data dimulai dari baris kedua
        foreach (array_slice($data[0], 1) as $row) {
            DB::table('mapel')->insert([
                'kode_mapel' => $row[1],
                'nama_mapel' => $row[2],
                'id_kelas' => $row[3],
                'id_jurusan' => $row[4],
            ]);
        }

        // Redirect atau berikan respons sukses
        return redirect()->back()->with('success', 'Import berhasil.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required',
            'kelas' => 'required',
        ]);

        // Find the mapel record by ID
        $mapel = Mapel::findOrFail($id);

        // Update the mapel record with the form data
        $mapel->nama_mapel = $request->input('nama_mapel');
        $mapel->kode_mapel = $request->input('kode_mapel');
        $mapel->id_kelas = $request->input('kelas');

        // Convert selectedJurusan to JSON and store in the database
        $selectedJurusan = $request->input('jurusan_mapel') ?? [];
        $mapel->id_jurusan = json_encode($selectedJurusan);

        // Save the updated mapel record
        $mapel->save();

        // Redirect to the index page with a success message
        return redirect()->route('mapel.index')->with('success', 'Mapel updated successfully');
    }
}
