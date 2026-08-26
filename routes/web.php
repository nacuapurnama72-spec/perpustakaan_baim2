<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\User\KatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard & Katalog Peminjaman Siswa (Lengkap dengan route pinjam & kembali)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [KatalogController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/pinjam', [KatalogController::class, 'store'])->name('user.pinjam');
    Route::patch('/dashboard/kembali/{id}', [KatalogController::class, 'kembali'])->name('user.kembali');
});

// Route Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Khusus Admin
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini khusus Admin.');
        }
        return view('admin.Dashboard');
    })->name('admin.dashboard');

    // Route CRUD Admin
    Route::resource('/admin/buku', BukuController::class, ['as' => 'admin']);
    Route::resource('/admin/user', UserController::class, ['as' => 'admin']);
    Route::resource('/admin/peminjaman', PeminjamanController::class, ['as' => 'admin']);
    Route::patch('/admin/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.kembali');
});

require __DIR__.'/auth.php';