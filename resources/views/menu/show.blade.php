<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Plato') }}
        </h2>
    </x-slot>

    <style>
        body {
            background-color: #f7fafc; /* Fondo suave */
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .image-thumbnail {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>

    <div class="container">
        <h3 class="text-lg font-semibold">{{ $menuItem->nombre_producto }}</h3>

        @if($menuItem->imagen_url)
            <img src="{{ asset($menuItem->imagen_url) }}" alt="{{ $menuItem->nombre_producto }}" class="image-thumbnail">
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
</x-app-layout>
