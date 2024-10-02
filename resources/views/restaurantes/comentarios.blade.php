<x-app-layout>
    @include('header.header')
    <br>
    <div class="container mx-auto my-8 px-4">
        <h2 class="text-3xl font-bold text-center text-orange-600 mb-8">Comentarios para {{ $restaurante->nombre }}</h2>

        @if ($comentarios->isEmpty())
            <p class="text-gray-600 text-center">No hay comentarios para este restaurante.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-lg rounded-lg">
                    <thead>
                        <tr class="bg-orange-600 text-black">
                            <th class="py-3 px-6 text-left">Cliente</th>
                            <th class="py-3 px-6 text-left">Comentario</th>
                            <th class="py-3 px-6 text-center">Calificación</th>
                            <th class="py-3 px-6 text-center">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comentarios as $comentario)
                            <tr>
                                <td>{{ $comentario->cliente->nombre }}</td> <!-- Aquí se muestra el nombre del cliente -->
                                <td>{{ $comentario->comentario }}</td>
                                <td class="text-center">{{ $comentario->calificacion }}</td>
                                <td class="text-center">{{ $comentario->fecha }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <br>
</x-app-layout>
