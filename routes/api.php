<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Both ways are work perfectly as the same.
Route::post('/categories/upsert', [CategoryController::class, 'upsert']);
Route::post('/categories/save', [CategoryController::class, 'save']);
// Route::post('/categories/upsert', 'App\Http\Controllers\CategoryController@upsert');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::get('/categories', [CategoryController::class, 'get']);

// Product
Route::get('/products/{id?}', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'detail']);
Route::delete('/product/destroy', [ProductController::class, 'destroy']);
// Use for adding new product into database
Route::post('/product/add', [ProductController::class, 'store']);
