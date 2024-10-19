<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // Autenticar las credenciales del usuario
        $request->authenticate();

        // Obtener el usuario autenticado
        $user = User::where('email', $request->email)->first();

        // Generar un token de API con Sanctum
        $token = $user->createToken('API Token')->plainTextToken;

        // Devolver el token en la respuesta
        return response()->json(['token' => $token], 200);
    }

    /**
     * Destroy an authenticated session (Log out).
     */
    public function destroy(Request $request)
    {
        // Revocar todos los tokens del usuario autenticado
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
