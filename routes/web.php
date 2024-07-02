<?php

use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {return view('index');})->name('top');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

// 以下ログインユーザー 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('/delivery-address', [DeliveryAddressController::class, 'store'])->name('delivery-address.store');
    Route::get('/delivery-addresses', [DeliveryAddressController::class, 'getUserAddresses'])->name('delivery-addresses');
    
    // 管理ユーザー変更（本番環境で管理ユーザー作成後、admin middleware下に移動する）
    Route::get('/profile/d2fb69863001227d6eb57c1747c28682',[ProfileController::class, 'editRole'])->name('profile.d2fb69863001227d6eb57c1747c28682');
    Route::POST('/profile/06dcb1f31edd373e5f8a99ad7f76129a74e408e7',[ProfileController::class, 'updateRole'])->name('profile.06dcb1f31edd373e5f8a99ad7f76129a74e408e7');
    
    // 管理ユーザー
    Route::middleware('admin')->group(function () {
        Route::resource('products', ProductController::class)->except(['show']);
        Route::post('products/{product}/skus', [ProductController::class, 'storeSku'])->name('products.skus.store');
        Route::put('products/{product}/skus/{sku}', [ProductController::class, 'updateSku'])->name('products.updateSku');
        Route::delete('/products/skus/{sku}', [ProductController::class, 'destroySku'])->name('products.destroySku');
    });
});

Route::get('products/list', [ProductController::class, 'list'])->name('products.list');
Route::get('products/{product}',[ProductController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';
