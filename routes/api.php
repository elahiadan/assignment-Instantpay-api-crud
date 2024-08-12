<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;

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

// User Routes
Route::post('signup', [UserController::class, 'signup']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Board Routes
    Route::get('boards', [BoardController::class, 'index']);
    Route::post('boards', [BoardController::class, 'store']);
    Route::put('boards/{id}', [BoardController::class, 'update']);
    Route::delete('boards/{id}', [BoardController::class, 'destroy']);

    // Task Routes
    Route::get('tasks', [TaskController::class, 'index']);
    Route::post('tasks', [TaskController::class, 'store']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);

    // Logout Route
    Route::post('logout', [UserController::class, 'logout']);
});