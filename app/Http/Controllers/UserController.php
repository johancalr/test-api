<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'usuarios' => User::all(),
            'mensaje' => 'Lista de usuarios obtenida exitosamente'
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'usuario' => $user,
            'mensaje' => 'Usuario encontrado exitosamente'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json([
            'usuario' => $user,
            'mensaje' => 'Usuario actualizado exitosamente'
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'mensaje' => 'Usuario eliminado exitosamente'
        ]);
    }
}
