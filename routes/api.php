<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AbsenApiController;

Route::get('/jurnals', [AbsenApiController::class, 'index']);
Route::post('/jurnals', [AbsenApiController::class, 'store']);
Route::get('/jurnals/{id}', [AbsenApiController::class, 'show']);
Route::put('/jurnals/{id}', [AbsenApiController::class, 'update']);
Route::delete('/jurnals/{id}', [AbsenApiController::class, 'destroy']);