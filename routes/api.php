<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InteractionController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signup']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'adminmiddleware'])->group(function () {
    Route::get('users', [AdminController::class, 'index']);
    Route::post('users', [AdminController::class, 'store']);
    Route::put('users/{id}', [AdminController::class, 'update']);
    Route::delete('users/{id}', [AdminController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('interactions', [InteractionController::class, 'index']);
    Route::get('interactions/{id}', [InteractionController::class, 'show']);
    Route::post('interactions', [InteractionController::class, 'store']);
    Route::put('interactions/{id}', [InteractionController::class, 'update']);
    Route::delete('interactions/{id}', [InteractionController::class, 'destroy']);
});
