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
                            @error('nombre')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $restaurante->direccion) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            @error('direccion')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $restaurante->telefono) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            @error('telefono')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="horario" class="block text-sm font-medium text-gray-700">Horario</label>
                            <input type="text" name="horario" id="horario" value="{{ old('horario', $restaurante->horario) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            @error('horario')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $restaurante->categoria) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            @error('categoria')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="Activo" {{ old('estado', $restaurante->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Pendiente" {{ old('estado', $restaurante->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            </select>
                            @error('estado')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
