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

Route::get('/produk_vue', function () {
    return view('produk_page');
});

Route::get('/{pathMatch}', function() {
    return view('produk_page');
})->where('pathMatch', ".*");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('role:user');
Route::get('/about', function () {
    $data = [
        'pageTitle' => 'Tentang Kami',
        'content' => 'Ini adalah halaman tentang kami.'
    ];
    return view('about', $data);
});



Route::middleware(['auth', 'user','admin'])->group(function() {
    Route::resource('/produk', 'App\Http\Controllers\ProdukController');
});

// Route::resource('/product_vue', 'TaskController');

// Route::resource('/product', 'App\Http\Controllers\ProductController');