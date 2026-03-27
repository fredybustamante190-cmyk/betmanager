<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('authsesion')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});


Route::middleware(['authsesion','admin'])->group(function () {
    Route::get('/crear-admin', [UsuarioController::class, 'create']);
});