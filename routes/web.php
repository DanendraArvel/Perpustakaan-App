<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/success', function () {
    return view('success');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'Login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/jurnals/create', [AbsenController::class, 'create'])->name('jurnals.create');
    Route::post('/jurnals', [AbsenController::class, 'store'])->name('jurnals.store');
    });
    
Route::middleware(['auth', 'checkToken'])->group(function () {
    Route::get('/jurnals', [AbsenController::class, 'index'])->name('jurnals.index');
    Route::get('/jurnals/{id}/show', [AbsenController::class, 'show'])->name('jurnals.show');
    Route::get('/jurnals/{id}/edit', [AbsenController::class, 'edit'])->name('jurnals.edit');
    Route::put('/jurnals/{id}', [AbsenController::class, 'update'])->name('jurnals.update');
    Route::delete('/jurnals/{id}', [AbsenController::class, 'destroy'])->name('jurnals.destroy');
});
    