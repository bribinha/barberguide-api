<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas privadas
Route::middleware('auth:sanctum')->group(function () {
    // Obtém os dados do usuário logado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Faz o logout do usuário logado
    Route::post('/logout', [AuthController::class, 'logout']);

    // Criar um novo agendamento
    Route::post('/appointments', [AppointmentController::class, 'store']);
});

// Rota para verificar disponibilidade
Route::get('/professionals/{professional}/availability', [AvailabilityController::class, 'show']);

// Rota para buscar um único profissional pelo ID
Route::get('/professionals/{user}', [UserController::class, 'show']);

// Rota para listar todos profissionais
Route::get('/professionals', [UserController::class, 'index']);



