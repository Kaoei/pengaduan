<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/show/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('/pengaduan/edit/{id}', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/update/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/delete/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.delete');
});