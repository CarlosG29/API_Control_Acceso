<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;



// Rutas de autenticación
Route::post('/register', [RegisterController::class, 'store']); // Ruta de registro de usuario
Route::post('/login', [AuthenticatedSessionController::class, 'store']); // Ruta de inicio de sesión (login)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']); // Ruta de cierre de sesión (logout)

// Grupo de rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {

    // Rutas relacionadas con los posts
    Route::get('/posts', [PostController::class, 'index']); // Obtener lista de posts
    Route::post('/posts', [PostController::class, 'store']); // Crear un nuevo post
    Route::get('/posts/{post}', [PostController::class, 'show']); // Ver un post específico
    Route::put('/posts/{post}', [PostController::class, 'update']); // Actualizar un post
    Route::delete('/posts/{post}', [PostController::class, 'destroy']); // Eliminar un post
    
});
