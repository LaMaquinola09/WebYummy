<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 style="text-align:center;">Iniciar Sesión</h2>

    <form method="POST" action="{{ route('login') }}" style="border: 3px solid #f1f1f1; padding: 20px; border-radius: 10px;" class="py-3">
        @csrf

        <div class="imgcontainer" style="text-align: center; margin: 24px 0 12px 0;">
            <img src="{{ asset('images/img_avatar2.png') }}" alt="Avatar" class="avatar"
                style="width: 40%; border-radius: 50%; margin: 0 auto;">
        </div>

        <!-- Email Address -->
        <div>
            <label for="email"><b>Email</b></label>
            <input type="email" id="email" class="block mt-1 w-full" name="email" :value="old('email')" required autofocus autocomplete="username"
                style="width: 100%; padding: 12px 20px; margin: 8px 0; border: 1px solid #ccc; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password"><b>Contraseña</b></label>
            <input type="password" id="password" class="block mt-1 w-full" name="password" required autocomplete="current-password"
                style="width: 100%; padding: 12px 20px; margin: 8px 0; border: 1px solid #ccc; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="container" style="padding: 16px; background-color: #f1f1f1; margin-top: 16px;">
            <button type="submit" style="background-color: #04AA6D; color: white; padding: 14px 20px; border: none; cursor: pointer; width: 100%; margin: 8px 0;">Iniciar Sesión</button>
            @if (Route::has('password.request'))
                <span class="psw" style="float: right; padding-top: 16px;">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </span>
            @endif
        </div>
    </form>
</x-guest-layout>
