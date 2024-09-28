<x-app-layout>
    @include('header.header')

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
        text-align: center;
        /* Centrar contenido */
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

    .btn-custom {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        color: white;
        background-color: #f0ad4e;
        /* Color de fondo amarillo */
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s, transform 0.2s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        /* Espacio debajo del botón */
    }

    .btn-custom:hover {
        background-color: #ec971f;
        /* Color más oscuro al pasar el ratón */
        transform: translateY(-2px);
        /* Efecto de elevación */
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        /* Espacio entre título y botón */
        align-items: center;
        /* Alinear verticalmente */
        margin-bottom: 20px;
        /* Espaciado superior */
    }

    .image-thumbnail {
        width: 50px;
        /* Ajusta el tamaño de la imagen según lo necesites */
        height: auto;
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

    .btn-edit {
        background-color: #ec860a;
        /* Azul */
    }

    .btn-edit:hover {
        background-color: #bd4c00;
    }

    .btn-delete {
        background-color: #dc3545;
        /* Rojo */
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .btn-view {
        background-color: #28a745;
        /* Verde */
    }

    .btn-view:hover {
        background-color: #218838;
    }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <div class="header-container">
                        <h3 class="text-lg font-semibold">Platos Registrados</h3>

                    </div>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th scope="col" class="py-3 px-6 text-left">#</th>
                                <th scope="col" class="py-3 px-6 text-left">Cliente</th>
                                <th scope="col" class="py-3 px-6 text-left">Producto</th>
                                <th scope="col" class="py-3 px-6 text-left">Precio</th>
                                <th scope="col" class="py-3 px-6 text-center" id="accion">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">

                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <th scope="row" class="py-3 px-6"></th>
                                <td class="py-3 px-6">



                                </td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>