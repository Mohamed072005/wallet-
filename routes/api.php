<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/create/count', [\App\Http\Controllers\CountController::class, 'store']);
Route::middleware("auth:sanctum")->get('/home', [\App\Http\Controllers\CountController::class, 'home']);
Route::post('/send', [\App\Http\Controllers\TransaccioneController::class, 'send']);
//Route::get('/history', [\App\Http\Controllers\TransaccioneController::class, 'history'])->middleware("auth:sanctum");
