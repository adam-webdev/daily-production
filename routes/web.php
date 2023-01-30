<?php

use App\Http\Controllers\{DashboardController, ProduksiController, UserController};
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    // hanya admin yang dapat akses route ini
    Route::resource('/user', UserController::class);
    Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

    Route::resource('/produksi', ProduksiController::class);
    Route::get('/produksi/hapus/{id}', [ProduksiController::class, "delete"]);

    Route::get('/export-produksi', [ProduksiController::class, 'ExportExcel'])->name('export-excel');
    Route::get('/export-produksi-csv', [ProduksiController::class, 'ExportCSV'])->name('export-csv');
    Route::get('/import-data', [ProduksiController::class, 'ViewImportData'])->name('import-data');
    Route::post('/import-data', [ProduksiController::class, 'ImportData'])->name('import');
});