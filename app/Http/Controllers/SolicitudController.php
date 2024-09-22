<?php

namespace App\Http\Controllers;

use App\Models\User; // Importar el modelo User
use App\Models\Restaurante; // Importar el modelo Restaurant
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SolicitudController extends Controller
{
    public function index()
    {
        return view('solicitudRestaurante.notificacion');
    }

    public function create()
    {
        return view('solicitudRestaurante.Solicitud');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:10',
            'password' => 'required|string|confirmed|min:8',
            'nombre_negocio' => 'required|string|max:255',
            'categoria' => 'required|string|max:50',
            'hora_apertura' => 'required',
            'hora_cierre' => 'required',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede tener más de 10 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'nombre_negocio.required' => 'El nombre del negocio es obligatorio.',
            'categoria.required' => 'La categoría es obligatoria.',
            'hora_apertura.required' => 'La hora de apertura es obligatoria.',
            'hora_cierre.required' => 'La hora de cierre es obligatoria.',
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'tipo' => 'restaurante',
        ]);
    
        // Crear un nuevo restaurante relacionado con el usuario
        Restaurante::create([
            'user_id' => $user->id,
            'nombre' => $request->nombre_negocio,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'horario' => $request->hora_apertura . ' - ' . $request->hora_cierre,
            'estado' => 'Pendiente',
            'categoria' => $request->categoria,
        ]);

        return view('solicitudRestaurante.Solicitud')->with('success', 'Restaurante registrado con éxito');
    }
}
