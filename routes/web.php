<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
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
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'signIn'])->name('signIn');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/register', [AuthController::class, 'signUp'])->name('signUp');
Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');

Route::get('/products', [ProductController::class, 'index'])->name('products')->middleware('auth');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth');

Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::post('/cart', [CartController::class, 'addToCart'])->name('addToCart')->middleware('auth');

Route::post('/category_result)', [ProductController::class, 'filterWithCategory'])->name('filterWithCategory')->middleware('auth');
