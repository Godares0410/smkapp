<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jurusan;
use App\Models\BankSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banksoal = BankSoal::select('bank_soal.*', 'mapel.nama_mapel', 'mapel.id_jurusan', 'mapel.id_kelas')
            ->join('mapel', 'bank_soal.id_mapel', '=', 'mapel.id_mapel')
            ->get();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapel = Mapel::select('mapel.*', 'kelas.nama_kelas')
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id_kelas')
            ->get();

        return view('data_ujian.bank_soal.index', compact('banksoal', 'kelas', 'jurusan', 'mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $bank = $request->input('nama_bank_soal');

        $request->validate([
            'mapel' => 'required|not_in:pilih_kelas',
        ], [
            'mapel.not_in' => 'Mapel Tidak Boleh Kosong',
        ]);
        // Simpan data ke database
        $mapel = new BankSoal;
        $mapel->nama_bank_soal = $request->nama_bank_soal;
        $mapel->id_mapel = $request->mapel;
        $mapel->save();

        // Buat folder baru di public_path jika belum ada
        // $folderPath = public_path('bank_soal/' . $bank);
        // if (!file_exists($folderPath)) {
        //     mkdir($folderPath, 0777, true);
        // }

        return redirect()->back()->with('success', 'Mapel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function show(BankSoalController $bankSoalController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function edit(BankSoalController $bankSoalController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankSoalController $bankSoalController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan BankSoal berdasarkan ID
        $mapel = BankSoal::findOrFail($id);

        // Hapus folder terkait
        $folderPath = public_path('bank_soal/' . $mapel->nama_bank_soal);
        if (file_exists($folderPath)) {
            $this->deleteFolder($folderPath);
        }
        Soal::where('id_bank_soal', $id)->delete();
        // Hapus record dari database
        $mapel->delete();

        return redirect()->back()->with('success', 'Mapel berhasil dihapus');
    }

    private function deleteFolder($folderPath)
    {
        // Hapus semua file di dalam folder
        $files = glob($folderPath . '/*');
        foreach ($files as $file) {
            unlink($file);
        }

        // Hapus folder itu sendiri
        rmdir($folderPath);
    }
}
