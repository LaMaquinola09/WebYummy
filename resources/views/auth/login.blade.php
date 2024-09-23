<x-guest-layout>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/estilos.css">
    </head>

    <body>
        <div class="contenedor">
            <div class="contenedor-formulario">
                <div class="imagen-formulario"
                    style="background-image: url('{{ asset('images/comida_banner.jpg') }}');">
                    <!-- Aquí puedes agregar contenido si es necesario -->
                </div>



                <form class="formulario" aria-label="Formulario de Inicio de Sesión" method="POST"
                    action="{{ route('login') }}">
                    @csrf
                    <div class="texto-formulario">
                        <h2>Bienvenido de nuevo</h2>
                        <p>Inicia sesión con tu cuenta</p>
     

                    </div>
                    <div class="input">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required autofocus>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="input">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña"
                            required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="password-olvidada">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                        @endif
                    </div>
                    <div class="input">
                        <input type="submit" value="Iniciar Sesión"
                            style="background-color: #04AA6D; color: white; padding: 14px 20px; border: none; cursor: pointer; width: 100%;">
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
</x-guest-layout>