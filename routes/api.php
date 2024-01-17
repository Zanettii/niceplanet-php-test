<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ProdutorController;
use App\Http\Controllers\Api\PropriedadeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/propriedade', [PropriedadeController::class, 'store'])->name('propiedade');
    Route::post('/propriedade', [PropriedadeController::class, 'show'])->name('propiedade');

    Route::post('/produtor', [ProdutorController::class, 'store'])->name('produtor');
    Route::post('/produtor', [ProdutorController::class, 'show'])->name('produtor');
});
