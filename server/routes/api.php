<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SkinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/skins', [SkinController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/skin', [SkinController::class, 'store']);
    Route::get('/skin/{id}', [SkinController::class, 'show']);
    Route::post('/skin/{id}', [SkinController::class, 'update']);
    Route::delete('/skin/{id}', [SkinController::class, 'destroy']);
});
