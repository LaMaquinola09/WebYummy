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
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     $user = User::find($request->user()->id);
        
    //     if($user->tipo == 'admin'){
    //         $pendingRestaurants = Restaurante::where('estado', 'Pendiente')->with('user')->get();
    //         return redirect()->intended(RouteServiceProvider::HOME_ADMIN)->with([
    //             'user' => $user,
    //             'pendingRestaurants' => $pendingRestaurants,
    //         ]);
            
    //     } else if($user->tipo == 'restaurante'){
    //         $restaurant = $user->restaurant;
    //         if($restaurant->estado == 'Pendiente'){
    //             Auth::guard('web')->logout();

    //             $request->session()->invalidate();

    //             $request->session()->regenerateToken();

    //             return redirect('/');
    //         } else if($restaurant->estado == 'Activo'){
    //             return redirect()->intended(RouteServiceProvider::HOME);
    //         }
    //     }
    // }


    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = User::find($request->user()->id);

    if ($user) {
        if ($user->tipo == 'admin') {
            $pendingRestaurants = Restaurante::where('estado', 'Pendiente')->with('user')->get();
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN)->with([
                'user' => $user,
                'pendingRestaurants' => $pendingRestaurants,
            ]);
        } else if ($user->tipo == 'restaurante') {
            $restaurant = $user->restaurant;

            if ($restaurant) { // Verifica si el restaurante existe
                if ($restaurant->estado == 'Pendiente') {
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('/')->withErrors(['error' => 'Su restaurante está pendiente de aprobación.']);
                } else if ($restaurant->estado == 'Activo') {
                    return redirect()->intended(RouteServiceProvider::HOME); // Redirige a la vista correspondiente
                }
            } else {
                // Manejar el caso donde no hay restaurante asociado
                return redirect('/')->withErrors(['error' => 'No se encontró el restaurante asociado.']);
            }
        }
    } else {
        return redirect('/')->withErrors(['error' => 'Usuario no encontrado.']);
    }
}




















    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}