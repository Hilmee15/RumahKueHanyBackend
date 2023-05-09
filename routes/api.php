<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Category API Routing
Route::resource('/categories', CategoryController::class);

// Cake API Routing
Route::resource('/cakes', CakeController::class);

// Auth Routing
Route::post('/register',[ AuthController::class, 'register']); //register
Route::post('/login', [AuthController::class, 'login']); //login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); //logout
