<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\BankUjian;
use App\Models\JadwalUjian;
use Illuminate\Http\Request;
use App\Models\SesiJadwalUjian;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $jadwalujian = JadwalUjian::all();
        // $bankUjian = BankUjian::all();
        $bank = BankUjian::select('bank_ujian.*', 'kelas.nama_kelas', 'jenis_ujian.nama_ujian', 'mapel.nama_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
            ->join('jenis_ujian', 'jenis_ujian.id_jenis', '=', 'bank_ujian.id_jenis')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
            ->get();
        $jadwal = JadwalUjian::select('jadwal_ujian.*', 'mapel.nama_mapel', 'kelas.nama_kelas', 'bank_ujian.id_jurusan', 'bank_ujian.jumlah_soal')
            ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
            ->get();
        $sesi = Sesi::all();
        return view('data_ujian.jadwal_ujian.index', compact('bank', 'sesi', 'jadwal'));
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
        // Validate the form data
        $validator = $request->validate([
            'bank_ujian' => 'required',
            'durasi' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'sesi.*' => 'exists:sesi,id_sesi', // Validate that each sesi exists in the 'sesi' table
            'jam_mulai.*' => 'nullable|date_format:H:i', // Allow null or valid time format
            'jam_selesai.*' => 'nullable|date_format:H:i', // Allow null or valid time format
        ]);

        // Insert data into the database
        $sesiIds = $request->input('sesi');
        $durasi = $request->input('durasi');
        $mulai = $request->input('mulai');
        $selesai = $request->input('selesai');
        $jamMulai = $request->input('jam_mulai');
        $jamSelesai = $request->input('jam_selesai');
        $bank = $request->input('bank_ujian');

        // Assuming you have a Jadwal model with a relationship to Sesi model
        $jadwal = new JadwalUjian();
        $jadwal->id_bank_ujian = $bank;
        $jadwal->durasi = $durasi;
        $jadwal->tgl_mulai = $mulai;
        $jadwal->tgl_selesai = $selesai;
        $jadwal->save();

        $insertData = [];
        // $sesiIds = $request->input('sesi');

        foreach ($sesiIds as $index => $sesiId) {
            $jamMulaiValue = $request->input("jam_mulai.$index");
            $jamSelesaiValue = $request->input("jam_selesai.$index");

            // Check if the sesi ID is checked and both jam_mulai and jam_selesai are not null
            if ($request->has("sesi.$index") && $jamMulaiValue !== null && $jamSelesaiValue !== null) {
                $insertData[] = [
                    'id_jadwal_ujian' => $jadwal->id,
                    'id_sesi' => $sesiId,
                    'jam_mulai' => $jamMulaiValue,
                    'jam_selesai' => $jamSelesaiValue,
                ];
            }
        }

        // Perform the multiple insert
        SesiJadwalUjian::insert($insertData);

        return redirect()->back()->with('success', 'Jadwal created successfully');
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
        //
    }
}
