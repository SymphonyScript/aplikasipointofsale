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

    Route::prefix('user')->group(function (){
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('/store', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
    });

    Route::prefix('product')->group(function (){
        Route::prefix('category')->group(function (){
            Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('product.category.index');
            Route::get('/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('product.category.create');
            Route::post('/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('product.category.store');
            Route::get('/edit/{category}', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('product.category.edit');
            Route::put('/update/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('product.category.update');
            Route::get('/delete/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('product.category.delete');
        });

        Route::prefix('unit')->group(function (){
            Route::get('/', [\App\Http\Controllers\UnitController::class, 'index'])->name('product.unit.index');
            Route::get('/create', [\App\Http\Controllers\UnitController::class, 'create'])->name('product.unit.create');
            Route::post('/store', [\App\Http\Controllers\UnitController::class, 'store'])->name('product.unit.store');
            Route::get('/edit/{unit}', [\App\Http\Controllers\UnitController::class, 'edit'])->name('product.unit.edit');
            Route::put('/update/{unit}', [\App\Http\Controllers\UnitController::class, 'update'])->name('product.unit.update');
            Route::get('/delete/{unit}', [\App\Http\Controllers\UnitController::class, 'destroy'])->name('product.unit.delete');
        });

        Route::prefix('item')->group(function (){
            Route::get('/', [\App\Http\Controllers\ItemController::class, 'index'])->name('product.item.index');
            Route::get('/create', [\App\Http\Controllers\ItemController::class, 'create'])->name('product.item.create');
            Route::post('/store', [\App\Http\Controllers\ItemController::class, 'store'])->name('product.item.store');
            Route::get('/edit/{item}', [\App\Http\Controllers\ItemController::class, 'edit'])->name('product.item.edit');
            Route::put('/update/{item}', [\App\Http\Controllers\ItemController::class, 'update'])->name('product.item.update');
            Route::get('/delete/{item}', [\App\Http\Controllers\ItemController::class, 'destroy'])->name('product.item.delete');
            Route::get('/qr/{item}', [\App\Http\Controllers\ItemController::class, 'qr'])->name('product.item.qr');
            Route::get('/get-item', [\App\Http\Controllers\ItemController::class, 'getItem'])->name('product.item.get-item');
        });
    });

    Route::prefix('stock')->group(function (){
        Route::prefix('in')->group(function (){
            Route::get('/', [\App\Http\Controllers\StockInController::class, 'index'])->name('stock.in.index');
            Route::get('/create', [\App\Http\Controllers\StockInController::class, 'create'])->name('stock.in.create');
            Route::post('/store', [\App\Http\Controllers\StockInController::class, 'store'])->name('stock.in.store');
            Route::get('/edit/{stock}', [\App\Http\Controllers\StockInController::class, 'edit'])->name('stock.in.edit');
            Route::put('/update/{stock}', [\App\Http\Controllers\StockInController::class, 'update'])->name('stock.in.update');
            Route::get('/delete/{stock}', [\App\Http\Controllers\StockInController::class, 'destroy'])->name('stock.in.delete');
        });

        Route::prefix('out')->group(function (){
            Route::get('/', [\App\Http\Controllers\StockOutController::class, 'index'])->name('stock.out.index');
            Route::get('/create', [\App\Http\Controllers\StockOutController::class, 'create'])->name('stock.out.create');
            Route::post('/store', [\App\Http\Controllers\StockOutController::class, 'store'])->name('stock.out.store');
            Route::get('/edit/{stock}', [\App\Http\Controllers\StockOutController::class, 'edit'])->name('stock.out.edit');
            Route::put('/update/{stock}', [\App\Http\Controllers\StockOutController::class, 'update'])->name('stock.out.update');
            Route::get('/delete/{stock}', [\App\Http\Controllers\StockOutController::class, 'destroy'])->name('stock.out.delete');
        });
    });

    Route::prefix('transaction')->group(function (){
        Route::get('/create', [\App\Http\Controllers\TransactionController::class, 'create'])->name('transaction.create');
        Route::post('/store', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
        Route::get('/delete/{transaction}', [\App\Http\Controllers\TransactionController::class, 'destroy'])->name('transaction.delete');
        Route::get('/statistic', [\App\Http\Controllers\TransactionController::class, 'statistic'])->name('transaction.statistic');
    });

    Route::prefix('report')->group(function (){
        Route::prefix('transaction')->group(function (){
            Route::get('/', [\App\Http\Controllers\ReportTransactionController::class, 'index'])->name('report.transaction.index');
        });

        Route::prefix('stock')->group(function (){
            Route::get('/in', [\App\Http\Controllers\ReportStockController::class, 'in'])->name('report.stock.in');
            Route::get('/out', [\App\Http\Controllers\ReportStockController::class, 'out'])->name('report.stock.out');
        });
    });
});
