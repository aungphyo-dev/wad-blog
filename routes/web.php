<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    "register" => false,
    "password/reset"=>false
]);
Route::middleware('auth')->prefix('dashboard')->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('users',[HomeController::class,'users'])->name('users');
    Route::resource('blog', \App\Http\Controllers\BlogController::class);
});

