<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');

    Route::get('/store', function() {
        $products = Product::where('stock', '>', 0)->get();
        return view('store', compact('products'));
    })->name('store');
});

Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.all');
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
