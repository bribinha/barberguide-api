<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::where('role', 'professional')->get();
        return response()->json($users);
    }

    public function show(User $user): JsonResponse
    {
        // Verifica se o usuário encontrado é de fato um profissional
        if ($user->role !== 'professional') {
            // Retorna um 404 Not Found se o ID for de um cliente, por exemplo.
            abort(404, 'Profissional não encontrado.');
        }
        return response()->json($user);
    }
}
