<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request): JsonResponse
    {
        // Validação automática no RegisterUserRequest
        $validatedData = $request->validated();

        // Cria o novo usuário
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'cliente' // Por padrão, todo novo registro é de um cliente
        ]);

        // Retorna uma resposta de sucesso com os dados do usuário criado
        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'user' => $user
        ], 201);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        // Validação automática no LoginUserRequest
        $validatedData = $request->validated();

        // Tenta autenticar o usuário com as credenciais fornecidas
        if (!Auth::attempt($request->only('email', 'password'))) {
            // Se a autenticação falhar, retorna um erro
            return response()->json([
                'error' => 'Credenciais inválidas.'
            ], 401); // 401 Unauthorized
        }

        // Se a autenticação for bem-sucedida, busca o usuário
        $user = $request->user();

        // Cria um token de API para o usuário.
        // O 'plainTextToken' é a string do token que enviaremos ao fronteend.
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retorna o token e os dados do usuário
        return response()->json([
            'message' => 'Login bem-sucedido',
            'user' => $user,
            'access_token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        // Revoga (invalida) o token de acesso atual do usuário.
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso!'
        ]);
    }
}
