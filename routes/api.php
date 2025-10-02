<?php

use App\Http\Controllers\Api\AvailabilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
