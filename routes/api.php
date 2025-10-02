<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rota para verificar disponibilidade
Route::get('/professionals/{professional}/availability', [AvailabilityController::class, 'show']);

// Rota para buscar um único profissional pelo ID
Route::get('/professionals/{user}', [UserController::class, 'show']);

// Rota para listar todos profissionais
Route::get('/professionals', [UserController::class, 'index']);

// Rota para criar um novo agendamento
Route::post('/appointments', [AppointmentController::class, 'store']);
