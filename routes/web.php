<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

// Página principal
use App\Http\Controllers\InicioController;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

// Registro de usuarios normales
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registro', [AuthController::class, 'register'])->name('register.post');

// Login y logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas para cualquier usuario con sesión
Route::middleware('authsesion')->group(function () {

    Route::resource('apuestas', \App\Http\Controllers\ApuestaController::class);

    Route::resource('registro-financieros', \App\Http\Controllers\RegistroFinancieroController::class);

});

// Rutas SOLO para ADMIN
Route::middleware(['authsesion', 'admin'])->group(function () {

    Route::resource('usuarios', UsuarioController::class)->except(['create']);

    Route::get('/crear-admin', [UsuarioController::class, 'create'])->name('usuarios.create');

});