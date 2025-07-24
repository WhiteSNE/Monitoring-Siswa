<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Daftar alias middleware 'role'
Route::aliasMiddleware('role', RoleMiddleware::class);

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/datasiswa', 'admin.datasiswa')->name('admin.datasiswa');
    Route::view('/dataguru', 'admin.dataguru')->name('admin.dataguru');
    Route::view('/datadudi', 'admin.datadudi')->name('admin.datadudi');
    Route::view('/dokumen', 'admin.dokumen')->name('admin.dokumen');
    Route::view('/nilai', 'admin.nilai')->name('admin.nilai');
    Route::view('/role', 'admin.role')->name('admin.role');
    Route::view('/kelas', 'admin.kelas')->name('admin.kelas');
    Route::view('/jabatan', 'admin.jabatan')->name('admin.jabatan');
    Route::view('/jurusan', 'admin.jurusan')->name('admin.jurusan');
});

Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function(){
    Route::view('/bimbingan', 'guru.bimbingan')->name('guru.bimbingan');
    Route::view('/dokumen', 'guru.dokumen')->name('guru.dokumen');
    Route::view('/jurnal', 'guru.jurnal')->name('guru.jurnal');
    Route::view('/nilai', 'guru.nilai')->name('guru.nilai');
});

Route::prefix('dudi')->middleware(['auth', 'role:dudi'])->group(function(){
    Route::view('/jurnal', 'dudi.jurnal')->name('dudi.jurnal');
    Route::view('/nilai', 'dudi.nilai')->name('dudi.nilai');
});

Route::prefix('murid')->middleware(['auth', 'role:siswa'])->group(function(){
    Route::view('/jurnal', 'murid.jurnal')->name('murid.jurnal');
    Route::view('/dokumen', 'murid.dokumen')->name('murid.dokumen');
});


// Default halaman login
Route::get('/', function () {
    return view('loginpage');
});

// Admin only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    })->name('guru.dashboard');
});

Route::middleware(['auth', 'role:dudi'])->group(function () {
    Route::get('/dudi/dashboard', function () {
        return view('dudi.dashboard');
    })->name('dudi.dashboard');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/murid/dashboard', function () {
        return view('murid.dashboard');
    })->name('murid.dashboard');
});

// General dashboard (bisa untuk user biasa)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
