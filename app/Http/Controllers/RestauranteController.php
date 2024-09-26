<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RestauranteController extends Controller
{
    public function index()
    {
        // Retorna la vista para los restaurantes
        return view('restaurantes.index');
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
}
