<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Plato') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <style>
 

                    .image-thumbnail {
                        max-width: 100%;
                        height: auto;
                        border-radius: 8px;
                    }
                    </style>

                   
                        <h3 class="text-lg font-semibold">{{ $menuItem->nombre_producto }}</h3>

                        @if($menuItem->imagen_url)
                        <img src="{{ asset($menuItem->imagen_url) }}" alt="{{ $menuItem->nombre_producto }}"
                            class="image-thumbnail">
                        @else
                        <p>Sin imagen disponible.</p>
                        @endif

                        <div class="mt-4">
                            <strong>Descripción:</strong>
                            <p>{{ $menuItem->descripcion }}</p>
                        </div>

                        <div class="mt-2">
                            <strong>Precio:</strong>
                            <p>${{ number_format($menuItem->precio, 2) }}</p>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('menu.index') }}" class="btn-custom">Volver al Menú</a>
                        </div>
                  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>