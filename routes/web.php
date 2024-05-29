<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/anggota');
});

Route::get('/buku',[BukuController::class,'index']);
Route::get('/anggota',[AnggotaController::class,'index']);
Route::get('/peminjaman/{id}/detail', [AnggotaController::class, 'detailJson'])->name('peminjaman.detail');
Route::get('/peminjaman',[PeminjamanController::class,'index']);
Route::get('/peminjaman/{id}/detailJson', [PeminjamanController::class, 'detailJson'])->name('peminjaman.detail');
