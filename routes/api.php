<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdnController;
use App\Http\Controllers\StatsController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/mutation', [AdnController::class, 'verificar']);
Route::get('/stats', [StatsController::class, 'stats']);
Route::get('/list', [AdnController::class, 'list']);
