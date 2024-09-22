<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación de los campos, incluyendo el rol
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'], // Validación del nombre
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class], // Validación del email
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Validación de la contraseña
            'direccion' => ['required', 'string', 'max:255'], // Validación de la dirección
            'telefono' => ['required', 'string', 'max:20'], // Validación del teléfono
            'vehiculo' => ['nullable', 'in:moto,bicicleta,ninguno'], // Validación del vehículo (opcional)
            'rol' => ['required', 'in:cliente,repartidor,restaurante'], // Validación del rol

        ]);

        // Creación del usuario con los nuevos campos
        $user = User::create([
            'nombre' => $request->nombre, // Guardar nombre
            'email' => $request->email, // Guardar email
            'tipo' => 'restaurante', // Encriptar y guardar contraseña
            'direccion' => $request->direccion, // Guardar dirección
            'telefono' => $request->telefono, // Guardar teléfono
            'password' => Hash::make($request->password) // Guardar rol
        ]);

        // Disparar el evento de registro
        event(new Registered($user));

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        // Redirigir al home después de registrarse
        return redirect(RouteServiceProvider::HOME);
    }
}
