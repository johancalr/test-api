<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'mobile_phone' => 'required|string|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $token = JWTAuth::fromUser($user);

        // Guardar el token en remember_token
        $user->setAttribute('remember_token', $token);
        $user->save();

        return response()->json([
            'usuario' => $user,
            'token' => $token,
            'mensaje' => 'Usuario registrado exitosamente'
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('mobile_phone', 'password');

        // Intentar autenticarse
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Guardar el token en remember_token
        $user->setAttribute('remember_token', $token);
        $user->save();

        $expires_in = JWTAuth::factory()->getTTL() * 60; // Tiempo de expiración en segundos

        // Retornar la información del usuario y el token
        return response()->json([
            'usuario' => $user,
            'token' => $token,
            'expires_in' => $expires_in,
            'mensaje' => 'Inicio de sesión exitoso'
        ]);
    }

    public function refreshToken()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());

        // Actualiza el remember_token con el nuevo token
        $user = Auth::user();
        $user->setAttribute('remember_token', $newToken);
        $user->save();

        return response()->json([
            'token' => $newToken,
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'mensaje' => 'Token actualizado exitosamente'
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        // Elimina el remember_token en la base de datos
        $user = Auth::user();
        $user->setAttribute('remember_token', null);
        $user->save();

        return response()->json(['mensaje' => 'Cerrar sesión exitoso']);
    }
}
