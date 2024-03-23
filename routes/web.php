<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminMahasiswaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', [MahasiswaController::class, 'index'])->name('home');
Route::get('/mahasiswa/search', [MahasiswaController::class, 'search'])->name('mahasiswa.search');

Route::get('/admin', [AdminMahasiswaController::class, 'index'])->name('admin.index');
Route::get('/admin/create', [AdminMahasiswaController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminMahasiswaController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminMahasiswaController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminMahasiswaController::class, 'update'])->name('admin.update');
Route::delete('/admin/destroy/{id}', [AdminMahasiswaController::class, 'destroy'])->name('admin.destroy');
