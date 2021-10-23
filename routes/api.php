<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
// Route::post('/categories/upsert', 'App\Http\Controllers\CategoryController@upsert');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
