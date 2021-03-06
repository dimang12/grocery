<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(["verify" => true]);


//Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category', [CategoryController::class, 'index'])->name('category')->middleware('verified');
Route::get('/category/{cate}', [CategoryController::class, 'detail'])->name('category-detail')->middleware('verified');
Route::get('/admin/{any?}', [AdminController::class, 'menu'])
    ->name('admin')
    ->middleware('can:admin')
    ->where('any', '.*');

Route::get('/home/{any?}', [HomeController::class, 'index'])
    ->name('home')
    ->where('any', '.*')
;
