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
                // Usa \DateTime para referenciar la clase DateTime de PHP
                $fecha_activo = new \DateTime($restaurant->active_at);
                $hoy = new \DateTime(); // Crear un objeto DateTime para la fecha actual
                $dias = $fecha_activo->diff($hoy)->days; // Calcular la diferencia en días

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
                    if($restaurant->estado_membresia === 'Y'){
                        
                    } else {
                        // Redirigir a la ruta de pago si han pasado más de 15 días
                        return redirect()->route('restaurantes.pay-fee')->withErrors([
                            'estado' => 'Han pasado más de 15 días desde que su restaurante estuvo activo. Debe realizar un pago.',
                        ]);
                    }
                }
            } else {
                // Manejar el caso donde no hay un restaurante asociado al usuario
                return redirect()->back()->withErrors([
                    'error' => 'No se encontró un restaurante asociado a este usuario.',
                ]);
            }
        }

        // Si todo está bien, continuar con la solicitud
        return $next($request);
    }
}
