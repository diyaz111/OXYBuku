<?php

use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePostRequest;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('bukus', BukuController::class);

    Route::group(['middleware' => ['is.admin:1']], function() {
        Route::resource('users', UserController::class);
    });
});