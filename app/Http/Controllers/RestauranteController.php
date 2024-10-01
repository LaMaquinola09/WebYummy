<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Models\Categoria;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RestauranteController extends Controller
{
    public function index()
    {
        // Obtener todos los restaurantes independientemente de su estado
        $restaurants = Restaurante::with('categoria')->get();
    
        // Retorna la vista para los restaurantes y pasa los datos
        return view('restaurantes.index', compact('restaurants'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        // Obtener el usuario autenticado
        $user = Auth::user(); // Asegúrate de usar el método Auth::user() para obtener al usuario autenticado

        if (!$user) {
            return redirect()->route('login')->withErrors([
                'error' => 'No se ha iniciado sesión correctamente. Intente nuevamente.',
            ]);
        }

        // Obtener el restaurante por su ID
        $restaurante = Restaurante::findOrFail($id);

        // Cambiar el estado del restaurante (por ejemplo, a "Aprobado")
        $restaurante->estado = 'Activo';
        $restaurante->active_at = date('Y-m-d H:i:s');

        // Guardar los cambios en la base de datos
        $restaurante->save();

        // Regenerar la sesión solo si todo está en orden
        $request->session()->regenerate();

        // Si el usuario es un administrador, redirigirlo al dashboard de admin
        if ($user->tipo == 'admin') {
            // Obtener los restaurantes pendientes
            $pendingRestaurants = Restaurante::where('estado', 'Pendiente')->with('user')->get();
        
            // Almacenar los restaurantes pendientes en la sesión
            session(['pendingRestaurants' => $pendingRestaurants]);
        
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN)->with([
                'user' => $user,
            ]);
        }

        // Redirigir al home para otros tipos de usuarios
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function pay_fee(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user(); // Asegúrate de usar el método Auth::user() para obtener al usuario autenticado

        if (!$user || $user->tipo == 'admin') {
            return redirect()->route('adminDash');
        }
        // Retorna la vista para los restaurantes
        return view('restaurantes.pay_fee');
    }

    //Para editar los datos de un restaurante
    public function edit($id)
    {
        // Obtener el restaurante por su ID
        $restaurante = Restaurante::findOrFail($id);
        $categorias = Categoria::all();

        // Retornar la vista de edición con los datos del restaurante
        return view('restaurantes.edit', compact('restaurante', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        // Validar los campos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'direccion' => 'required|string|min:15|max:255|regex:/^[\p{L}0-9\s#,.]+$/u',
            'telefono' => 'required|numeric|digits_between:10,10',
            'horario_apertura' => 'required|date_format:H:i',
            'horario_cierre' => 'required|date_format:H:i|after:horario_apertura',
            'categoria_id' => 'required|exists:categorias,id',
            'estado' => 'required|string|max:50',
        ], [
            'nombre.required' => 'El nombre del restaurante es obligatorio.',
            'nombre.regex' => 'Coloca solo letras y espacios',
            'direccion.regex' => 'Coloca solo letras, espacios y números',
            'direccion.min' => 'Coloca al menos 15 caracteres',
            'horario_apertura.date_format' => 'Seleccione horarios válidos',
            'horario_cierre.after' => 'El cierre del horario debe ser una hora posterior a la apertura del horario.',
            'telefono.numeric' => 'El teléfono debe ser un número válido.',
            'telefono.digits_between' => 'El teléfono debe tener 10 dígitos.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);
    
        // Obtener el restaurante
        $restaurante = Restaurante::findOrFail($id);
    
        // Actualizar los datos del restaurante
        $restaurante->nombre = $request->input('nombre');
        $restaurante->direccion = $request->input('direccion');
        $restaurante->telefono = $request->input('telefono');
        
        // Concatenar horario de apertura y cierre en la columna 'horario'
        $horario_apertura = $request->input('horario_apertura');
        $horario_cierre = $request->input('horario_cierre');
        $restaurante->horario = $horario_apertura . ' - ' . $horario_cierre;
        
        $restaurante->estado = $request->input('estado');
        
        // Actualizar la relación con la categoría
        $restaurante->categoria_id = $request->input('categoria_id');
        
        // Guardar los cambios en la base de datos
        $restaurante->save();
        
        // Actualizar el restaurante con los datos validados
        // $restaurante->update($request->all());
        return redirect()->route('restaurantes.index')->with('success', 'Restaurante actualizado correctamente.');
    }
    
}
