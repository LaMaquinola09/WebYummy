<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Restaurantes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Lista de restaurantes registrados en la app") }}
                </div>
                <!-- @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif -->
                @if(isset($restaurants) && count($restaurants) > 0)
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
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Email</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-gray-600">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($restaurants as $restaurante)
                                    <tr>
                                        <td class="py-3 px-4">{{ $restaurante->nombre }}</td>
                                        <td class="py-3 px-4">{{ $restaurante->direccion }}</td>
                                        <td class="py-3 px-4">{{ $restaurante->telefono }}</td>
                                        <td class="py-3 px-4">{{ $restaurante->horario }}</td>
                                        <td class="py-3 px-4">{{ $restaurante->categoria }}</td>
                                        <td class="py-3 px-4">{{ $restaurante->estado }}</td>
                                        <td class="py-3 px-4">{{ $restaurante->user->email ?? 'Sin asignar' }}</td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('restaurantes.edit', $restaurante->id) }}" class="text-blue-500">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-600">No se encontraron restaurantes</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Mostrar alertas de éxito o error -->
    <script>
        @if(session('success'))
            Swal.fire({
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: '¡Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        @endif
    </script>

</x-app-layout>
