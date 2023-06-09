<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AdressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressOptionController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/cart', function () {
    return Inertia::render('Cart');
})->name('cart.index');

Route::get('/category/{id}',[CategoryController::class,'index'] )->name('category.index');
Route::get('/product/{id}',[ProductController::class,'index'] )->name('product.index');
Route::get('/address',[AdressController::class,'index'] )->name('address.index');
Route::get('/address_options',[AddressOptionController::class,'index'] )->name('address.index');
Route::post('/address_options',[AddressOptionController::class,'store'] )->name('address_options.store');
Route::delete('/address_options/{id}',[AddressOptionController::class,'destroy'] )->name('address_options.destroy');





Route::middleware('auth')->group(function () {

    Route::get('/address_options',[AddressOptionController::class,'index'] )->name('address.index');
    Route::post('/address_options',[AddressOptionController::class,'store'] )->name('address_options.store');
    Route::delete('/address_options/{id}',[AddressOptionController::class,'destroy'] )->name('address_options.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::put('/checkout', [CheckoutController::class, 'update'])->name('checkout.update');


});

require __DIR__.'/auth.php';
