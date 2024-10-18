<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class MobileAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validación de los datos que vienen en el request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Si falla la validación
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Intentar iniciar sesión con las credenciales proporcionadas

        if ($request->authenticate()) {
            // El usuario fue autenticado correctamente
            $user = Auth::user();

            // Puedes generar un token de API para la app móvil

            return response()->json([
                'message' => 'Login successful',
                'user' => $user
            ], 200);
        } else {
            // Si las credenciales no son correctas
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}
