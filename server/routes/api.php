<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SkinController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/skins/available', [SkinController::class, 'available']);
Route::get('/skin/getskin/{id}', [SkinController::class, 'getskin']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/skins/buy', [SkinController::class, 'buy']);
    Route::get('/skins/myskins', [SkinController::class, 'myskins']);
    Route::put('/skins/color', [SkinController::class, 'color']);
    Route::delete('/skins/delete/{id}', [SkinController::class, 'delete']);
});