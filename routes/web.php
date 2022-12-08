<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KegiatanController;

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

//anggota
Route::middleware('CekLogin')->group(function () {
    Route::get('/', [AnggotaController::class, 'home'])->name('home');
    Route::get('/home', [AnggotaController::class, 'home'])->name('home.anggota');
    Route::get('/kegiatan', [KegiatanController::class, 'kegiatan'])->name('kegiatan');
});


Route::get('/login', [AnggotaController::class, 'login'])->name('login');
Route::post('/loginproses', [AnggotaController::class, 'loginproses'])->name('login.anggota');
Route::get('/logout', [AnggotaController::class, 'logout'])->name('logout');
Route::get('/admin', [UserController::class, 'loginadmin'])->name('login.admin');
Route::post('/prosesadmin', [UserController::class, 'prosesadmin'])->name('proses.admin');

//admin
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/home', [HomeController::class, 'homeadmin'])->name('homeadmin');
    Route::get('/admin/absensi', [AbsensiController::class, 'dataAbsensi'])->name('dataAbsensi');

    Route::get('/liatmaps/{id}', [AbsensiController::class, 'liatMap'])->name('liatMap');
    Route::get('/admin/pdfabsensi', [AbsensiController::class, 'pdfAbsensi'])->name('pdfAbsensi');
    Route::get('/admin/excelabsensi', [AbsensiController::class, 'excelAbsensi'])->name('excelAbsensi');
    Route::get('/admin/datacsv', [AbsensiController::class, 'datacsv'])->name('datacsv');
    Route::get('/admin/notabsensi', [AbsensiController::class, 'belumAbsensi'])->name('belumAbsensi');
    Route::get('/admin/anggota', [AnggotaController::class, 'dataAnggota'])->name('dataAnggota');
    Route::get('/admin/pdfanggota', [AnggotaController::class, 'pdfAnggota'])->name('pdfAnggota');
    Route::get('/admin/excelanggota', [AnggotaController::class, 'excelAnggota'])->name('excelAnggota');
});



// $data = DB::table('anggotas')->select(
//     'cabangs.nama',
//     COUNT(['absensis.id_anggota as totalanggota']),
//     'absensis.id_anggota as totalabsen'
// )
//     ->leftjoin('cabangs', 'anggotas.id_cabang', '=', 'cabangs.id')
//     ->leftjoin('absensis', 'anggotas.username', '=', 'absensis.id_anggota')
//     ->groupBy('cabangs.id')->get();
// dd($data);