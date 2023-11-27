<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\BankSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_bank_soal = $request->input('id_bank_soal');

        $bank = BankSoal::where('id_bank_soal', $id_bank_soal)
            ->select('nama_bank_soal', 'id_bank_soal')
            ->first();
        $soal = Soal::where('id_bank_soal', $id_bank_soal)
            ->get();
        $jml = Soal::where('id_bank_soal', $id_bank_soal)
            ->count();
        return view('data_ujian.soal.index', compact('soal', 'jml', 'bank'));
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
        //
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
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->back()->with('success', 'Mapel berhasil dihapus');
    }
    public function importExcel(Request $request, $id_bank_soal)
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
            // Remove spaces from the uploaded file name in $row[7]
            $fileName = str_replace(' ', '', $row[7]);
    
            // Convert the file name to uppercase
            $fileName = strtoupper($fileName);
    
            // Insert data into the 'soal' table
            DB::table('soal')->insert([
                'id_bank_soal' => $id_bank_soal,
                'soal' => $row[1],
                'pil_a' => $row[2],
                'pil_b' => $row[3],
                'pil_c' => $row[4],
                'pil_d' => $row[5],
                'pil_e' => $row[6],
                'jawaban' => $fileName, // Store the modified file name in 'jawaban' field
                'file_1' => $row[9], // Keep the original file name in 'file_1' field
            ]);
        }
    
        // Redirect atau berikan respons sukses
        return redirect()->back()->with('success', 'Import berhasil.');
    }

    public function uploadPhoto(Request $request, $bankId)
    {
        $bank = BankSoal::findOrFail($bankId);

        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $folderPath = public_path('bank_soal/' . $bank->nama_bank_soal);

        if ($request->hasFile('images')) {
            // Periksa dan buat direktori jika belum ada
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            foreach ($request->file('images') as $photo) {
                // Simpan file di direktori yang benar
                $filename = $photo->getClientOriginalName();
                $photo->move($folderPath, $filename);

                // Jika perlu, simpan informasi file ke dalam database
                // $bank->update(['photo' => $filename]);
            }

            return redirect()->back()->with('success', 'Photos uploaded successfully');
        } else {
            return redirect()->back()->with('error', 'No files selected');
        }
    }
}
