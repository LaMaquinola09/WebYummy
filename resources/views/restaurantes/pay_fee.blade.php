<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-200 leading-tight">
            {{ __('PAGO DE MENSUALIDAD PARA LOS RESTAURANTES') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Necesita realizar el pago para continuar disfrutando del servicio de Yummy.") }}
                </div>
                @if(session('estado'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        {{ session('estado') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>