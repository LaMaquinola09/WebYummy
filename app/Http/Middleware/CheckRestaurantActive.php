<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRestaurantActive
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es un restaurante
        if (Auth::check() && Auth::user()->tipo === 'restaurante') {
            $restaurant = Auth::user()->restaurante;

            if ($restaurant) {
                $fechaActivo = new \DateTime($restaurant->active_at);
                $hoy = new \DateTime(); 
                $dias = $fechaActivo->diff($hoy)->days;

                // Si el restaurante no está activo, redirigir al login
                if ($restaurant->estado != 'Activo') {
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'estado' => 'Su restaurante no está activo en el sistema. Por favor, contacte al administrador.',
                    ]);
                }

                // Si han pasado más de 15 días, redirigir a la página de pago
                if ($dias >= 15) {
                    return redirect()->route('pay-fee')->withErrors([
                        'estado' => 'Han pasado más de 15 días desde que su restaurante estuvo activo. Debe realizar un pago.',
                    ]);
                }
            } else {
                return redirect()->route('login')->withErrors([
                    'error' => 'No se encontró un restaurante asociado a este usuario.',
                ]);
            }
        }

        // Si todo está bien, continuar con la solicitud
        return $next($request);
    }
}
