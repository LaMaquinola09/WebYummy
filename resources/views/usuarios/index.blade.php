<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <style>
        /* Estilos personalizados */
        body {
            background-color: #f7fafc;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table th, .table td {
            padding: 1rem;
            text-align: center;
        }
        .table th {
            background-color: #4a5568;
            color: white;
        }
        .table tr:hover {
            background-color: #edf2f7;
        }
        .bg-white {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn-action {
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-edit { background-color: #ec860a; }
        .btn-edit:hover { background-color: #bd4c00; }
        .btn-delete { background-color: #dc3545; }
        .btn-delete:hover { background-color: #c82333; }
        .btn-view { background-color: #28a745; }
        .btn-view:hover { background-color: #218838; }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Usuarios Registrados</h3>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">#</th>
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-left">Rol</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                           
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <th class="py-3 px-6"></th>
                                    <td class="py-3 px-6"></td>
                                    <td class="py-3 px-6"></td>
                                    <td class="py-3 px-6"></td>
                                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
