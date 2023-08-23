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
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\GuruMapelController;
use App\Http\Controllers\JenisUjianController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        // activity()->log($user->name);
        return view('master');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {

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
    Route::resource('ujian', UjianController::class);
});