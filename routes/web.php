<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\MovieController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/movie', [App\Http\Controllers\MovieController::class, 'index'])->name('movie');
Route::get('/movie/search', [App\Http\Controllers\MovieController::class, 'search'])->name('search');
Route::post('/movie/searchresult', [App\Http\Controllers\MovieController::class, 'searchresult'])->name('searchresult');
Route::post('/movie/store', [App\Http\Controllers\MovieController::class, 'store'])->name('addmovie');
Route::post('/movie/update', [App\Http\Controllers\MovieController::class, 'update'])->name('updatemovie');
Route::get('/movie/delete/{id}', [App\Http\Controllers\MovieController::class, 'destroy']);

