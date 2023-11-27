<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipeMakanan = request('tipe_makanan'); // Ambil parameter 'tipe_makanan' dari URL
        $makanans = Makanan::when($tipeMakanan, function ($query) use ($tipeMakanan) {
            return $query->whereJsonContains('tipe_makanan', $tipeMakanan);
        })->get();
        return view('test.test', compact('makanans'));
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
         // Validasi formulir
         $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'tipe_makanan' => 'required|array',
        ]);

        // Mengonversi array ke dalam format yang sesuai untuk penyimpanan
        $tipeMakanan = json_encode($request->tipe_makanan);

        // Proses penyimpanan data
        $makanan = new Makanan([
            'nama_makanan' => $request->nama_makanan,
            'tipe_makanan' => $tipeMakanan,
        ]);

        $makanan->save();

        // Tampilkan pesan sukses
        return "Data Makanan berhasil disimpan!";
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
