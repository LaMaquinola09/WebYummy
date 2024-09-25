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
        // Autenticar al usuario
        $request->authenticate();

        // Obtener el usuario autenticado
        $user = User::find($request->user()->id);

        // Si el usuario es un restaurante, verificar el estado de su restaurante
        if ($user->tipo == 'restaurante') {
            // Obtener el restaurante asociado al usuario
            $restaurant = $user->restaurante;

            if ($restaurant) {
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

            return redirect()->intended(RouteServiceProvider::HOME_ADMIN)->with([
                'user' => $user,
                'pendingRestaurants' => $pendingRestaurants,
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
}