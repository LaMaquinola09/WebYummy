<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurante;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Intentar autenticar al usuario
            $request->authenticate();
        } catch (ValidationException $e) {
            // Si la autenticación falla, redirigir con un mensaje personalizado
            return redirect()->route('login')->withErrors([
                'credentials' => 'El correo o la contraseña son incorrectos. Por favor, intente nuevamente.',
            ]);
        }

        // Obtener el usuario autenticado
        $user = Auth::user(); // Asegúrate de usar el método Auth::user() para obtener al usuario autenticado

        if (!$user) {
            return redirect()->route('login')->withErrors([
                'error' => 'No se ha iniciado sesión correctamente. Intente nuevamente.',
            ]);
        }

        // Si el usuario es un restaurante, verificar el estado de su restaurante
        if ($user->tipo == 'restaurante') {
            // Verificar si el usuario tiene un restaurante asociado
            $restaurant = $user->restaurante;

            if ($restaurant) {
                // Usa \DateTime para referenciar la clase DateTime de PHP
                $fecha_activo = new \DateTime($restaurant->active_at);
                $fecha_pagado = new \DateTime($restaurant->paid_at);
                $hoy = new \DateTime(); // Crear un objeto DateTime para la fecha actual
                $dias = $fecha_activo->diff($hoy)->days; // Calcular la diferencia en días
                $dias_sin_pagar = $fecha_pagado->diff($hoy)->days;

                // Verificar si el restaurante está en estado pendiente
                if ($restaurant->estado != 'Activo') {
                    // Cerrar la sesión si el restaurante no está activo
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    // Redirigir al login con un mensaje de error
                    return redirect()->route('login')->withErrors([
                        'estado' => 'Su restaurante no está activo en el sistema. Por favor, contacte al administrador.',
                    ]);
                } else if ($dias >= 15) {
                    if($dias_sin_pagar >= 30){
                        $restaurant->update([
                            'estado_membresia' => 'N'
                        ]);
                        // Redirigir a la ruta de pago si han pasado más de 15 días
                        return redirect()->route('restaurantes.pay-fee')->withErrors([
                            'estado' => 'Han pasado más de 15 días desde que su restaurante estuvo activo. Debe realizar un pago.',
                        ]);
                    }
                    else if($restaurant->estado_membresia === 'N'){
                        // Redirigir a la ruta de pago si han pasado más de 15 días
                        return redirect()->route('restaurantes.pay-fee')->withErrors([
                            'estado' => 'Han pasado más de 15 días desde que su restaurante estuvo activo. Debe realizar un pago.',
                        ]);
                    } else {
                    }
                }
            } else {
                // Manejar el caso donde no hay un restaurante asociado al usuario
                return redirect()->back()->withErrors([
                    'error' => 'No se encontró un restaurante asociado a este usuario.',
                ]);
            }
        }

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

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cerrar sesión del usuario
        Auth::guard('web')->logout();

        // Invalidar la sesión
        $request->session()->invalidate();

        // Regenerar el token de sesión
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function destroy_get(Request $request): RedirectResponse
    {
        // Cerrar sesión del usuario
        Auth::guard('web')->logout();

        // Invalidar la sesión
        $request->session()->invalidate();

        // Regenerar el token de sesión
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
