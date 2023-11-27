<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jurusan;
use App\Models\BankSoal;
use App\Models\BankUjian;
use App\Models\JenisUjian;
use Illuminate\Http\Request;

class BankUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $jenis = JenisUjian::all();
        $bank = BankSoal::all();
        $bankujian = BankUjian::select('bank_ujian.*',
            'jenis_ujian.nama_ujian',
            'kelas.nama_kelas',
            'mapel.nama_mapel',
        )
            ->join('jenis_ujian', 'bank_ujian.id_jenis', '=', 'jenis_ujian.id_jenis')
            ->join('kelas', 'bank_ujian.id_kelas', '=', 'kelas.id_kelas')
            ->join('mapel', 'bank_ujian.id_mapel', '=', 'mapel.id_mapel')
            ->get();
        
        return view('data_ujian.ujian.index', compact('jenis','bankujian', 'kelas', 'jurusan', 'mapel', 'bank'));
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

        $jurusan = json_encode($request->jurusan_mapel);
        $bankSoal = json_encode($request->bank_soal);

        $ujian = new BankUjian;
        $ujian->id_jenis = $request->jenis;
        $ujian->id_kelas = $request->kelas;
        $ujian->id_mapel = $request->mapel;
        $ujian->id_bank_soal = $bankSoal;
        $ujian->id_jurusan = $jurusan;
        // $ujian->durasi = $request->durasi;
        $ujian->jumlah_soal = $request->jumlah_soal;
        $ujian->jumlah_opsi = $request->jumlah_opsi;
        $ujian->acak_soal = $request->acak_soal;
        $ujian->acak_opsi = $request->acak_jawaban;
        // dd($ujian);
        $ujian->save();
        return redirect()->route('bankujian.index')->with('success', 'Data Ujian Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan BankSoal berdasarkan ID
        $bankujian = BankUjian::findOrFail($id);
        $bankujian->delete();

        return redirect()->back()->with('success', 'Mapel berhasil dihapus');
    }
}
