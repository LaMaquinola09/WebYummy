<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ADMIN DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Bienvenido Administrador") }}
                </div>
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('pendingRestaurants') && count(session('pendingRestaurants')) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Nombre del Restaurante</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Dirección</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Teléfono</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Horario</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Categoría</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Estado</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Administrador</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Email</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Aprobar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('pendingRestaurants') as $restaurant)
                                    <tr class="border-b">
                                        <td class="text-left py-3 px-4">{{ $restaurant->nombre }}</td>
                                        <td class="text-left py-3 px-4">{{ $restaurant->direccion }}</td>
                                        <td class="text-left py-3 px-4">{{ $restaurant->telefono }}</td>
                                        <td class="text-left py-3 px-4">{{ $restaurant->horario }}</td>
                                        <td class="text-left py-3 px-4">{{ $restaurant->categoria }}</td>
                                        <td class="text-left py-3 px-4">{{ $restaurant->estado }}</td>
                                        <td class="text-left py-3 px-4">{{ $restaurant->user->nombre }}</td>
                                        <td class="text-left py-3 px-4">{{ $restaurant->user->email }}</td>
                                        <td class="text-left py-3 px-4">
                                            <form action="{{ route('restaurant.update.status', $restaurant->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                    Aprobar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-600">No se encontraron restaurantes pendientes</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
