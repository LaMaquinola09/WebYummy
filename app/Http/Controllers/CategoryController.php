<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // Modelo de Categoría

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Crear la categoría en la base de datos
        Categoria::create([
            'nombre' => $request->name,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Categoría registrada con éxito.');
    }
}
