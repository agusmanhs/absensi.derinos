<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LiburController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\UserController;
use App\Models\Absensi;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('login', [LoginController::class,'proses_login'])->name('proses_login');
Route::get('logout', [LoginController::class,'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
    Route::post('/admin/updateprofil', [AdminController::class, 'updateprofil'])->name('admin.update.profil');


    Route::post('/admin/terimaizin', [AdminController::class, 'terimaizin'])->name('admin.terima.izin');




    Route::get('/admin/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai');
    Route::post('/admin/pegawai/tambah', [PegawaiController::class, 'store'])->name('admin.tambah.pegawai');
    Route::put('/admin/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('admin.update.pegawai');
    Route::delete('/admin/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('admin.delete.pegawai');

    Route::get('/admin/lokasi', [LokasiController::class, 'index'])->name('admin.lokasi');
    Route::post('/admin/lokasi/tambah', [LokasiController::class, 'store'])->name('admin.tambah.lokasi');
    Route::put('/admin/lokasi/update/{id}', [LokasiController::class, 'update'])->name('admin.update.lokasi');
    Route::delete('/admin/lokasi/delete/{id}', [LokasiController::class, 'destroy'])->name('admin.delete.lokasi');

    Route::get('/admin/jabatan', [JabatanController::class, 'index'])->name('admin.jabatan');
    Route::post('/admin/jabatan/tambah', [JabatanController::class, 'store'])->name('admin.tambah.jabatan');
    Route::put('/admin/jabatan/update/{id}', [JabatanController::class, 'update'])->name('admin.update.jabatan');
    Route::delete('/admin/jabatan/delete/{id}', [JabatanController::class, 'destroy'])->name('admin.delete.jabatan');

    Route::get('/admin/libur', [LiburController::class, 'index'])->name('admin.libur');
    Route::post('/admin/libur/tambah', [LiburController::class, 'store'])->name('admin.tambah.libur');
    Route::delete('/admin/libur/delete/{id}', [LiburController::class, 'destroy'])->name('admin.delete.libur');

    Route::get('/admin/report/harian', [ReportController::class, 'index'])->name('admin.report.harian');
    Route::get('/admin/pdf/harian', [ReportController::class, 'pdfharian'])->name('admin.pdf.harian');

    Route::get('/admin/report/bulanan', [ReportController::class, 'reportbulanan'])->name('admin.report.bulanan');
    Route::get('/admin/pdf/bulanan', [ReportController::class, 'pdfbulanan'])->name('admin.pdf.bulanan');
    Route::get('/admin/pdf/pegawai', [ReportController::class, 'pdfpegawai'])->name('admin.pdf.pegawai');








});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profil', [UserController::class, 'profil'])->name('user.profil');
    Route::post('/user/updateprofil', [UserController::class, 'updateprofil'])->name('user.update.profil');


    Route::post('/user/masuk', [AbsensiController::class, 'masuk'])->name('absensi.masuk');
    Route::post('/user/keluar', [AbsensiController::class, 'keluar'])->name('absensi.keluar');
    Route::post('/user/izin', [AbsensiController::class, 'izin'])->name('user.izin');






});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/cc', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cache is cleared";
});