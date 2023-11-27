<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\SiswaKartu;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::select('siswa.*', 'kelas.nama_kelas', 'jurusan.nama_jurusan')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
            ->get();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('data_umum.siswa.index', compact('siswa', 'kelas', 'jurusan'));
    }
    public function dashboard()
    {
        // $guru = Guru::all();
        return view('siswa.dashboard');
    }
    public function store(Request $request)
    {

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('foto')) {
                $errorMessage = 'Gagal Upload, ukuran maksimal foto 2Mb';
                session()->flash('error', $errorMessage);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $siswa = new Siswa;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->id_kelas = $request->kelas;
        $siswa->id_jurusan = $request->jurusan;
        $siswa->username = $request->username;
        $siswa->password = bcrypt($request->password);
        // $siswa->rombel = $request->rombel ?? $request->kelas . ' ' . $request->jurusan;
        // $siswa->foto = $fotoName;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // $namaFoto = $foto->getClientOriginalName();
            $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            $foto->move(public_path('img/siswa'), $namaFoto);
            $siswa->foto = $namaFoto;
        }
        $siswa->save();
        $id_siswa = $siswa->id_siswa;
        if (session()->has('error')) {
            $errorMessage = session()->get('error');
            session()->forget('error');
            return redirect()->back()->with('error', $errorMessage);
        }
        $kartu = new SiswaKartu;
        $kartu->id_siswa = $id_siswa;
        $kartu->username = $request->username;
        $kartu->password = $request->password;
        $kartu->save();
        // Tampilkan pesan success
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
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

        foreach (array_slice($data[0], 1) as $row) {
            $siswaId = DB::table('siswa')->insertGetId([
                'nama_siswa' => $row[3],
                'id_kelas' => $row[4],
                'id_jurusan' => $row[6],
                'username' => $row[9],
                'password' => bcrypt($row[10]),
                'foto' => $row[6],
                'status' => $row[12] ?? 1,
            ]);
            DB::table('siswa_kartu')->insert([
                'id_siswa' => $siswaId,
                'username' => $row[9],
                'password' => $row[10],
            ]);
            DB::table('siswa_sesi')->insert([
                'id_siswa' => $siswaId,
                'id_sesi' => $row[7],
            ]);
        }
        // Redirect atau berikan respons sukses
        return redirect()->back()->with('success', 'Import berhasil.');
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::where('id_siswa', $id);
        $data = [
            'nama_siswa'     => $request->nama_siswa,
            'kelas'   => $request->kelas,
            'jurusan'   => $request->jurusan,
            'username'   => $request->username,
            'password'   => bcrypt($request->password),
        ];

        $siswu = Siswa::where('id_siswa', $id)->first();
        $fotoLama = $siswu->foto;
        if ($fotoLama) {
            // Hapus foto lama dari penyimpanan
            File::delete(public_path('img/siswa/' . $fotoLama));
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // $namaFoto = $foto->getClientOriginalName();
            $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            $foto->move(public_path('img/siswa'), $namaFoto);
            $data['foto'] = $namaFoto;
        }
        $siswa->update($data);

        $kartu = SiswaKartu::where('id_siswa', $id);
        $data2 = [
            'username'   => $request->username,
            'password'   => $request->password,
        ];
        $kartu->update($data2);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil di edit.');
    }

    public function destroy($id)
    {
        // Temukan BankSoal berdasarkan ID
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        $kartu = SiswaKartu::findOrFail($id);
        $kartu->delete();

        return redirect()->back()->with('success', 'Data Siswa Berhasil Dihapus');
    }
}
