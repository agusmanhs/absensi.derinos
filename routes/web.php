<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JabatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PegawaiController;

Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('login', [LoginController::class,'proses_login'])->name('proses_login');
Route::get('logout', [LoginController::class,'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai');
    Route::post('/admin/pegawai/tambah', [PegawaiController::class, 'store'])->name('admin.tambah.pegawai');
    Route::put('/admin/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('admin.update.pegawai');
    Route::delete('/admin/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('admin.delete.pegawai');

    Route::get('/admin/lokasi', [LokasiController::class, 'index'])->name('admin.lokasi');
    Route::post('/admin/lokasi/tambah', [LokasiController::class, 'store'])->name('admin.tambah.lokasi');

    Route::get('/admin/jabatan', [JabatanController::class, 'index'])->name('admin.jabatan');
    Route::post('/admin/jabatan/tambah', [JabatanController::class, 'store'])->name('admin.tambah.jabatan');






});

// Route::get('/', function () {
//     return view('welcome');
// });
