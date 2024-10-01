<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-200 leading-tight">
            {{ __('PAGO DE MENSUALIDAD PARA LOS RESTAURANTES') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container text-center">
                    <h1>¡Pago realizado con éxito!</h1>
                    <p>Gracias por realizar el pago. Tu restaurante ha sido actualizado.</p><br>
                    <p>En breve serás redirigido a la página principal.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            window.location.replace('{{ route("dashboard") }}');
        }, 4000);
    </script>
</x-app-layout>