<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\TipoUvaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
    // Route::get('get-product-chart-data', [ReportingController::class, 'getProductChartData']);


    // Route::post('create-favorite', [FavoriteController::class, 'store']);
Route::get('/parcelas', [ParcelaController::class, 'index'])->name('parcelas.index');
Route::get('/parcelas/{id}', [ParcelaController::class, 'show'])->name('parcelas.show');
Route::post('/parcelas', [ParcelaController::class, 'store'])->name('parcelas.store');
Route::put('/parcelas/{id}', [ParcelaController::class, 'update'])->name('parcelas.update');
Route::delete('/parcelas/{id}', [ParcelaController::class, 'destroy'])->name('parcelas.destroy');



Route::get('/tipos-uvas', [TipoUvaController::class, 'index'])->name('tipos-uvas.index');
Route::get('/tipos-uvas/{id}', [TipoUvaController::class, 'show'])->name('tipos-uvas.show');
Route::post('/tipos-uvas', [TipoUvaController::class, 'store'])->name('tipos-uvas.store');
Route::put('/tipos-uvas/{id}', [TipoUvaController::class, 'update'])->name('tipos-uvas.update');
Route::delete('/tipos-uvas/{id}', [TipoUvaController::class, 'destroy'])->name('tipos-uvas.destroy');
