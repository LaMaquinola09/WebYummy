<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;

class RestauranteController extends Controller
{
    public function index()
    {
        // Retorna la vista para los restaurantes
        return view('restaurantes.index');
    }

    public function updateStatus(Request $request, $id)
    {
        // Obtener el restaurante por su ID
        $restaurante = Restaurante::findOrFail($id);

        // Cambiar el estado del restaurante (por ejemplo, a "Aprobado")
        $restaurante->estado = 'Activo';

        // Guardar los cambios en la base de datos
        $restaurante->save();

        // Redirigir de nuevo con un mensaje de éxito
        return redirect()->back()->with('success', 'El estado del restaurante ha sido actualizado.');
    }
}
