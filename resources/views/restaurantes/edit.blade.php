<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Restaurante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('restaurantes.update', $restaurante->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $restaurante->nombre) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <!-- @error('nombre')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror -->
                        </div>

                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $restaurante->direccion) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <!-- @error('direccion')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror -->
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $restaurante->telefono) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <!-- @error('telefono')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror -->
                        </div>
                        @php
                            // Dividir el horario en apertura y cierre
                            $horario = explode(' - ', $restaurante->horario);
                            $horario_apertura = $horario[0] ?? '';
                            $horario_cierre = $horario[1] ?? '';
                        @endphp

                        <div class="mb-4">
                            <label for="horario_apertura" class="block text-sm font-medium text-gray-700">Horario Apertura</label>
                            <input type="time" name="horario_apertura" id="horario_apertura" value="{{ old('horario_apertura', $horario_apertura) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="horario_cierre" class="block text-sm font-medium text-gray-700">Horario Cierre</label>
                            <input type="time" name="horario_cierre" id="horario_cierre" value="{{ old('horario_cierre', $horario_cierre) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>


                        <div class="mb-4">
                            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <!-- <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $restaurante->categoria) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required> -->
                            <select name="categoria_id" id="categoria" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id', $restaurante->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- @error('categoria')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror -->
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="Activo" {{ old('estado', $restaurante->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Pendiente" {{ old('estado', $restaurante->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            </select>
                            <!-- @error('estado')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror -->
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(session('errors'))
            Swal.fire({
                title: '¡Error!',
                text: `@foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach`,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        @endif
    </script>
</x-app-layout>
