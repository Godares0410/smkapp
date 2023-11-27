<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\LogLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAuthController extends Controller
{
    public function index()
    {
        return view('login.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('guru')->attempt($credentials)) {
            // LogLogin::create([
            //     'nama_guru' => auth('guru')->user()->nama_guru,
            //     'id_guru' => auth('guru')->user()->id
            // ]);
            return redirect()->route('guru.dashboard');
        }

        // if (Auth::guard('siswa')->attempt($credentials)) {
        //     // Dapatkan alamat IP pengguna
        //     $ip = $request->ip();

        //     // LogLogin::create
        //     LogLogin::create([
        //         // 'nama_siswa' => auth('siswa')->user()->nama_siswa,
        //         // 'id_siswa' => auth('siswa')->user()->id_siswa,
        //         'nama_siswa' => auth('siswa')->user()->nama_siswa,
        //         'id_siswa' => auth('siswa')->user()->id_siswa,
        //         'ip' => $ip, // Menambahkan kolom IP
        //     ]);

        //     return redirect()->route('siswa.dashboard');
        // }

        if (Auth::guard('siswa')->attempt($credentials)) {
            $user = Auth::guard('siswa')->user();
    
            // Periksa status siswa
            if ($user->status) {
                // Login berhasil
                return redirect()->route('siswa.dashboard');
            } else {
                // Nonaktifkan login dan kembalikan pesan peringatan
                Auth::guard('siswa')->logout();
                return back()->with('gagal', 'Akun Anda dinonaktifkan. Silakan Hubungi Panitia!');
            }
        }


        return back()->withErrors(['message' => 'Login gagal']);
    }
    // Logout siswa

    public function forceLogout($userId)
{
    // Cek apakah user dengan $userId sedang login
    $user = User::find($userId); // Gantilah dengan model dan kolom yang sesuai
    if ($user && Auth::check() && Auth::id() == $userId) {
        Auth::logout();
        return redirect('/login')->with('status', 'Anda telah dipaksa logout.');
    }

    return redirect('/dashboard')->with('status', 'User tidak sedang login atau tidak ditemukan.');
}
    public function logout(Request $request)
    {
        $user = auth('siswa')->user();

        // Find and delete the log entry based on the user's information
        // LogLogin::where('id_siswa', $user->id_siswa)->delete();

        auth('siswa')->logout(); // Logout dengan guard 'siswa'
        $request->session()->invalidate();

        return redirect('/login');
    }
}
