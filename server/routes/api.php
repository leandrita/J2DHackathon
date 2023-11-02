<?php

use App\Http\Controllers\Api\SkinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/skins', [SkinController::class, 'index']);
Route::post('/skin', [SkinController::class, 'store']);
Route::get('/skin/{id}', [SkinController::class, 'show']);
Route::post('/skin/{id}', [SkinController::class, 'update']);
Route::delete('/skin/{id}', [SkinController::class, 'destroy']);
