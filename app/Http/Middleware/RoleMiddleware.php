<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            if (Auth::user()->rol !== $role) {
                // Redirigir a la vista por defecto si el rol no coincide
                return redirect()->route('home'); // Cambia 'home' por la ruta que desees
            }
        }

        return $next($request);
    }
}
