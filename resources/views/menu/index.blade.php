<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('RESTAURANTE DASHBOARD') }}
        </h2>
    </x-slot>
    <style>
    body {
        background-color: #f7fafc;
        /* Fondo suave */
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        padding: 1rem;
        text-align: left;
    }

    .table th {
        background-color: #4a5568;
        /* Color de encabezado */
        color: white;
    }

    .table tr:hover {
        background-color: #edf2f7;
        /* Color de resaltado al pasar el ratón */
    }

    .bg-white {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Sombra sutil */
    }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Platos Registrados</h3>
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th scope="col" class="py-3 px-6 text-left">#</th>
                                <th scope="col" class="py-3 px-6 text-left">Nombre</th>
                                <th scope="col" class="py-3 px-6 text-left">Descripción</th>
                                <th scope="col" class="py-3 px-6 text-left">Precio</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <th scope="row" class="py-3 px-6">1</th>
                                <td class="py-3 px-6">Mark</td>
                                <td class="py-3 px-6">Delicioso plato de pasta.</td>
                                <td class="py-3 px-6">$10.00</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <th scope="row" class="py-3 px-6">2</th>
                                <td class="py-3 px-6">Jacob</td>
                                <td class="py-3 px-6">Ensalada fresca.</td>
                                <td class="py-3 px-6">$8.00</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <th scope="row" class="py-3 px-6">3</th>
                                <td class="py-3 px-6">Larry</td>
                                <td class="py-3 px-6">Sopa de pollo.</td>
                                <td class="py-3 px-6">$7.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>