@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Catálogo de Productos</h1>
    
    <div class="mb-4">
        <a href="{{ route('admin.producto.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Producto</a>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Nombre</th>
                <th class="py-2 px-4 border-b">Precio</th>
                <th class="py-2 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td class="py-2 px-4 border-b">{{ $producto->id }}</td>
                <td class="py-2 px-4 border-b">{{ $producto->nombre }}</td>
                <td class="py-2 px-4 border-b">{{ $producto->precio }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('admin.producto.edit', $producto->id) }}" class="text-yellow-500">Editar</a>
                    <form action="{{ route('admin.producto.destroy', $producto->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection