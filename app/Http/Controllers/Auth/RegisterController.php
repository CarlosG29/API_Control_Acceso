<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',  // Validación de unicidad
                'password' => 'required|string|min:6|confirmed',
                'role' => 'in:user,admin',
            ]);

            // Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'user',  // Por defecto rol 'user'
            ]);

            // Retornar el usuario creado con el código 201
            return response()->json(['user' => $user], 201);

        } catch (ValidationException $e) {
            // Captura las excepciones de validación y retorna el error con código 422
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);

        } catch (Exception $e) {
            // Captura cualquier otra excepción y retorna el error con código 500
            return response()->json([
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
