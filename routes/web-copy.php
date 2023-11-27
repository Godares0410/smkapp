<?php

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\GuruMapel;
use App\Models\JenisUjian;
use App\Http\Controllers\KelasRombel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\SiswasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\BankSoalController;
use App\Http\Controllers\SetUjianController;
use App\Http\Controllers\BankUjianController;
use App\Http\Controllers\GuruMapelController;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\JenisUjianController;
use App\Http\Controllers\JadwalUjianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => redirect()->route('login'));

// Route::get('/login', [LoginAuthController::class, 'index'])->name('login');
Route::post('/login', [LoginAuthController::class, 'login'])->name('siswa.login');
Route::get('/logout', [LoginAuthController::class, 'logout']);


// <<AUTH ADMIN>>

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //Data Umum
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('guru_mapel', GuruMapelController::class);
    Route::delete('/guru_mapel/{id}', [GuruMapelController::class, 'destroy'])->name('guru_mapel.destroy');
    Route::resource('kelas_rombel', KelasRombel::class);

    //Import Data Umum
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::post('/guru/import', [GuruController::class, 'import'])->name('guru.import');
    Route::post('/mapel/import', [MapelController::class, 'import'])->name('mapel.import');
    Route::post('/jurusan/import', [JurusanController::class, 'import'])->name('jurusan.import');

    //Download Data Umum
    Route::get('/download-template', function () {
        // $filePath = public_path('file/template/upload_format.xlsx');
        $filePath = public_path('file\format\upload_format_siswa.xlsx');
        $fileName = 'upload_format_siswa.xlsx';
        return Response::download($filePath, $fileName);
    });
    Route::get('/download-template-guru', function () {
        $filePath = public_path('file\format\upload_format_guru.xlsx');
        $fileName = 'upload_format_guru.xlsx';
        return Response::download($filePath, $fileName);
    });
    Route::get('/download-template-mapel', function () {
        $filePath = public_path('file\format\upload_format_mapel.xlsx');
        $fileName = 'upload_format_mapel.xlsx';
        return Response::download($filePath, $fileName);
    });
    Route::get('/download-template-jurusan', function () {
        $filePath = public_path('file\format\upload_format_jurusan.xlsx');
        $fileName = 'upload_format_jurusan.xlsx';
        return Response::download($filePath, $fileName);
    });

    //Data Ujian
    Route::resource('jenis_ujian', JenisUjianController::class);
    Route::resource('sesi', SesiController::class);
    Route::resource('bankujian', BankUjianController::class);
    Route::delete('/bankujian/{id}', [BankUjianController::class, 'destroy'])->name('bank_ujian.destroy');
    Route::resource('banksoal', BankSoalController::class);
    Route::delete('/bank_soal/{id}', [BankSoalController::class, 'destroy'])->name('bank_soal.destroy');
    Route::post('/soal/{id_bank_soal}', [SoalController::class, 'importExcel'])->name('soal.import');
    Route::post('/bank/{id_bank_soal}/upload', [SoalController::class, 'uploadPhoto'])->name('soal_foto.upload');
    Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('soal.destroy');
    Route::resource('setujian', SetUjianController::class);
    Route::resource('soal', SoalController::class);
    Route::resource('jadwal_ujian', JadwalUjianController::class);
    // });
});



Route::get('/gurus', [GuruController::class, 'dashboard'])->name('guru.dashboard');

Route::middleware('auth.guru')->get('/login', function () {
    return view('login.login');
})->name('login');

// <<SISWA>>

// Route::group(['middleware' => 'auth:siswa'], function () {
Route::group(['middleware' => ['auth:siswa', 'checkUserStatus']], function () {
    Route::get('/menu', [SiswasController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/assesmen', [SiswasController::class, 'index'])->name('siswas.index');
    Route::post('/exam', [SiswasController::class, 'mengerjakan'])->name('siswas.mengerjakan');
    Route::post('/store', [SiswasController::class, 'tambah'])->name('siswas.tambah');
    // Route::resource('siswas', SoalController::class);
    Route::post('/exam/update', [SiswasController::class, 'update'])->name('siswas.update');
    Route::post('/exam/ragu', [SiswasController::class, 'ragu'])->name('siswas.ragu');
    // Route::resource('siswas', SiswasController::class);
});
Route::middleware('auth.siswa', 'checkUserStatus')->get('/login', function () {
    return view('login.login');
})->name('login');





Route::post('/store', [MakananController::class, 'store'])->name('store');
Route::get('/makanan', [MakananController::class, 'index'])->name('makanan');
