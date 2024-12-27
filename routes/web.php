<?php

use App\Http\Controllers\BaDendaImportController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InputanBidangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SetorDebetImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/', MasterPelanggaranImportController::class, 'test');
// Route::get('/import', [MasterPelanggaranImportController::class, 'index']);
// Route::post('/import-test', [MasterPelanggaranImportController::class, 'import']);
// Route::get('/import', [ImportController::class, 'index']);
// Route::get('/import-setor', [ImportController::class, 'import_setor']);
// Route::post('/import', [ImportController::class, 'import']);
// Route::post('/import-setor', [ImportController::class, 'import_setor_debet']);

Auth::routes();

Route::middleware(['auth', 'checkrole:admin,user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/detail-ba-denda', [BaDendaImportController::class, 'getBaDenda'])->name('detail-ba-denda');
    Route::get('/detail-ba-denda/export-pdf', [BaDendaImportController::class, 'exportPdf'])->name('detail-ba-denda.exportPdf');

    Route::get('/detail-setor-debet', [SetorDebetImportController::class, 'getSetorDebet'])->name('detail-setor-debet');
    Route::get('/detail-setor-debet/export-pdf', [SetorDebetImportController::class, 'exportPdf'])->name('detail-setor-debet.exportPdf');

    Route::get('/laporan/pidum', [LaporanController::class, 'indexPidum'])->name('laporan.pidum');
    Route::get('/laporan/pidum/export-pdf', [LaporanController::class, 'exportPdfPidum'])->name('laporan.exportPdfPidum');

    Route::get('/laporan/pidsus', [LaporanController::class, 'indexPidsus'])->name('laporan.pidsus');
    Route::get('/laporan/pidsus/export-pdf', [LaporanController::class, 'exportPdfPidsus'])->name('laporan.exportPdfPidsus');

    Route::get('/laporan/bb', [LaporanController::class, 'indexBb'])->name('laporan.bb');
    Route::get('/laporan/bb/export-pdf', [LaporanController::class, 'exportPdfBb'])->name('laporan.exportPdfBb');

    Route::get('/laporan/pembinaan', [LaporanController::class, 'indexPembinaan'])->name('laporan.pembinaan');
    Route::get('/laporan/pembinaan/export-pdf', [LaporanController::class, 'exportPdfPembinaan'])->name('laporan.exportPdfPembinaan');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');
});

Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/import-ba-denda', [BaDendaImportController::class, 'index']);
    Route::post('/import-ba-denda', [BaDendaImportController::class, 'import']);
    Route::delete('/delete-ba-denda', [BaDendaImportController::class, 'destroy']);

    Route::get('/import-setor-debet', [SetorDebetImportController::class, 'index']);
    Route::post('/import-setor-debet', [SetorDebetImportController::class, 'import']);
    Route::delete('/delete-setor-debet', [SetorDebetImportController::class, 'destroy']);

    Route::get('/bidang', [BidangController::class, 'index']);
    Route::get('/bidang-tambah', [BidangController::class, 'create']);
    Route::post('/bidang-tambah', [BidangController::class, 'store'])->name('bidang-tambah');
    Route::get('/bidang-edit/{id}', [BidangController::class, 'edit']);
    Route::put('/bidang-edit/{id}', [BidangController::class, 'update'])->name('bidang-edit');
    Route::delete('/bidang-delete/{id}', [BidangController::class, 'destroy'])->name('bidang-delete');

    Route::get('/inputan', [InputanBidangController::class, 'index']);
    Route::get('/inputan-tambah', [InputanBidangController::class, 'create']);
    Route::post('/inputan-tambah', [InputanBidangController::class, 'store'])->name('inputan-tambah');
    Route::get('/inputan-edit/{id}', [InputanBidangController::class, 'edit']);
    Route::put('/inputan-edit/{id}', [InputanBidangController::class, 'update'])->name('inputan-edit');
    Route::delete('/inputan-delete/{id}', [InputanBidangController::class, 'destroy'])->name('inputan-delete');
});
