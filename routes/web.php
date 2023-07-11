<?php


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

Route::controller(\App\Http\Controllers\PageController::class)->group(function (){
    Route::get('/',"index")->name('index');
    Route::get('blog-detail/{slug}','show')->name('blog.detail');
    Route::get('category/{slug}','categoryShow')->name('blogBy.category');
});

Route::resource('comment',\App\Http\Controllers\CommentController::class)->only(['store','update','destroy'])->middleware('auth');
Auth::routes([
//    "register" => false,
//    "password/reset"=>false
]);
Route::middleware('auth')->prefix('dashboard')->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('users',[HomeController::class,'users'])->name('users')->can('admin-only');
    Route::resource('blog', \App\Http\Controllers\BlogController::class);
    Route::resource('category',\App\Http\Controllers\CategoryController::class);
});

