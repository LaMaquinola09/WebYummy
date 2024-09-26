<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Providers\RouteServiceProvider;

class RestauranteController extends Controller
{
    public function index()
    {
        // Obtener todos los restaurantes independientemente de su estado
        $restaurants = Restaurante::all();
    
        // Retorna la vista para los restaurantes y pasa los datos
        return view('restaurantes.index', compact('restaurants'));
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
