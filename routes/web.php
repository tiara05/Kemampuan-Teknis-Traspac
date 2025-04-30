<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('home');

// Rute yang memerlukan autentikasi
Route::group(['middleware' => ['auth', 'verified']], function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pegawai Routes
    Route::resource('pegawai', PegawaiController::class);
    Route::group(['prefix' => 'pegawai', 'as' => 'pegawai.'], function () {
        // Custom routes untuk pegawai
        Route::get('delete/{pegawai}', [PegawaiController::class, 'delete'])->name('delete');
        Route::post('upload-photo/{pegawai}', [FileController::class, 'uploadPhoto'])->name('upload-photo');
        Route::get('pegawai/cetak-pdf', [PegawaiController::class, 'cetakPdf'])->name('cetak.pdf');
        Route::get('pegawai/export-excel', [PegawaiController::class, 'exportExcel'])->name('export.excel');

    });

    // File Upload Routes
    Route::delete('file/{path_base64}', [FileController::class, 'destroy'])->name('file.destroy');
});

require __DIR__.'/auth.php';
