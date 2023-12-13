<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function (){
    Route::prefix('supplier')->group(function (){
        Route::get('/', [\App\Http\Controllers\SupplierController::class, 'index'])->name('supplier.index');
        Route::get('/create', [\App\Http\Controllers\SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/store', [\App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{supplier}', [\App\Http\Controllers\SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('/update/{supplier}', [\App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/delete/{supplier}', [\App\Http\Controllers\SupplierController::class, 'destroy'])->name('supplier.delete');
    });
});
