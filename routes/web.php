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

    Route::prefix('customer')->group(function (){
        Route::get('/', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
        Route::get('/create', [\App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
        Route::post('/store', [\App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
        Route::get('/edit/{customer}', [\App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('/update/{customer}', [\App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
        Route::get('/delete/{customer}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.delete');
    });
});
