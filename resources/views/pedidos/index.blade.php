<x-app-layout>
    @include('header.header')
    <!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reportes de Pedidos - Yummy</title>

        <style>
        :root {
            --azul: #FC924A;
            --azulOscuro: #F98231;
            --azulTexto: #303F9F;
            --grisClaro: #f4f7f6;
            --grisOscuro: #6c757d;
            --azulBoton: #007bff;
            --azulBotonHover: #0056b3;
            --tabActivo: #ffd700;
            /* Color para la pestaña activa */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--grisClaro);
            margin: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: var(--grisOscuro);
            font-size: 2em;
            margin-bottom: 20px;
        }

        .reportes-de-ventas-page {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .reportes-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            background-color: var(--azulTexto);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 25px;
        }

        .tab {
            background-color: var(--azul);
            color: white;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            margin: 0;
            flex: 1;
            text-align: center;
            border-right: 1px solid var(--azulTexto);
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .tab:last-child {
            border-right: none;
        }

        .tab:hover {
            background-color: var(--azulOscuro);
        }

        .tab.active {
            background-color: var(--tabActivo);
            font-weight: bold;
        }

        .sales-report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .sales-report-table th {
            background-color: var(--azulTexto);
            color: white;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }

        .sales-report-table td {
            border: 1px solid #dee2e6;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            color: #555;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        .sales-report-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .sales-report-table tr:hover {
            background-color: #f1f3f5;
        }

        .totals {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: var(--grisOscuro);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn-exportar,
        .btn-imprimir,
        .btn-buscar {
            background-color: var(--azul);
            color: white;
            border: none;
            padding: 12px 30px;
            cursor: pointer;
            margin-left: 15px;
            border-radius: 25px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-exportar:hover,
        .btn-imprimir:hover {
            background-color: var(--azulOscuro);
        }

        .btn-buscar {
            background-color: var(--azulBoton);
            border-radius: 8px;
            margin-top: 25px;
        }

        .btn-buscar:hover {
            background-color: var(--azulBotonHover);
        }
        </style>
    </head>

    <div class="flex flex-col min-h-screen">
        <main class="flex-grow p-6 flex justify-center bg-gray-100">
            <div class="bg-white rounded-lg shadow-lg p-4 w-full mb-20">
                <h3 class="text-3xl font-bold text-gray-800 text-center">
                    {{ __('Reportes de Pedidos') }}
                </h3>

                <div class="reportes-tabs">
                    <button class="tab active" id="pedidos-aceptados">Pedidos Aceptados</button>
                    <button class="tab" id="pedidos-en-preparacion">En Preparación</button>
                    <button class="tab" id="pedidos-en-camino">En Camino</button>
                    <button class="tab" id="pedidos-entregados">Pedidos Entregados</button>
                </div>

                <div id="reportes-container">
                    <table class="sales-report-table">
                        <thead>
                            <tr>
                                <th>Número de Pedido</th>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#12347</td>
                                <td>Carlos López</td>
                                <td>Sushi Variado</td>
                                <td>02/09/2024</td>
                                <td>Aceptado</td>
                                <td>
                                    <button class="btn-buscar"
                                        onclick="cambiarEstado('#12347', 'en-preparacion')">Marcar como En
                                        Preparación</button>
                                    <button class="btn-buscar" onclick="rechazarPedido('#12347')">Rechazar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="totals">
                        <strong>Total Pedidos Aceptados:</strong> 1
                    </div>
                </div>

                <div class="actions">
                    <button class="btn-exportar">Exportar</button>
                    <button class="btn-imprimir">Imprimir</button>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const tabs = document.querySelectorAll(".tab");
                    const reportesContainer = document.getElementById("reportes-container");

                    function updateTable(view) {
                        let tableContent = "";

                        switch (view) {
                            case "pedidos-aceptados":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12347</td>
                                                <td>Carlos López</td>
                                                <td>Sushi Variado</td>
                                                <td>02/09/2024</td>
                                                <td>Aceptado</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="cambiarEstado('#12347', 'en-preparacion')">Marcar como En Preparación</button>
                                                    <button class="btn-buscar" onclick="rechazarPedido('#12347')">Rechazar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;

                            case "pedidos-en-preparacion":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12351</td>
                                                <td>María Gómez</td>
                                                <td>Pizza Margarita</td>
                                                <td>02/09/2024</td>
                                                <td>En Preparación</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="cambiarEstado('#12351', 'en-camino')">Marcar como En Camino</button>
                                                    <button class="btn-buscar" onclick="rechazarPedido('#12351')">Rechazar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;

                            case "pedidos-en-camino":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12352</td>
                                                <td>Juan Pérez</td>
                                                <td>Hamburguesa</td>
                                                <td>02/09/2024</td>
                                                <td>En Camino</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="cambiarEstado('#12352', 'entregado')">Marcar como Entregado</button>
                                                    <button class="btn-buscar" onclick="rechazarPedido('#12352')">Rechazar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;

                            case "pedidos-entregados":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12353</td>
                                                <td>Lucía Martínez</td>
                                                <td>Ensalada Caesar</td>
                                                <td>02/09/2024</td>
                                                <td>Entregado</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="verDetalles('#12353')">Ver Detalles</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;
                        }

                        reportesContainer.innerHTML = tableContent +
                            '<div class="totals"><strong>Total Pedidos ' + view.replace(/-/g, ' ').replace(
                                /(\w)/, (c) => c.toUpperCase()) + ':</strong> 1</div>';
                    }

                    tabs.forEach(tab => {
                        tab.addEventListener("click", () => {
                            tabs.forEach(t => t.classList.remove(
                            "active")); // Elimina la clase activa de todas las pestañas
                            tab.classList.add(
                            "active"); // Agrega la clase activa a la pestaña actual
                            updateTable(tab.id);
                        });
                    });

                    // Inicializa la tabla con la vista por defecto
                    updateTable(tabs[0].id);
                });
                </script>
            </div>
        </main>
    </div>
</x-app-layout>
<x-app-layout>
    @include('header.header')
    <!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reportes de Pedidos - Yummy</title>

        <style>
        :root {
            --azul: #FC924A;
            --azulOscuro: #F98231;
            --azulTexto: #303F9F;
            --grisClaro: #f4f7f6;
            --grisOscuro: #6c757d;
            --azulBoton: #007bff;
            --azulBotonHover: #0056b3;
            --tabActivo: #ffd700;
            /* Color para la pestaña activa */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--grisClaro);
            margin: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: var(--grisOscuro);
            font-size: 2em;
            margin-bottom: 20px;
        }

        .reportes-de-ventas-page {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .reportes-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            background-color: var(--azulTexto);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 25px;
        }

        .tab {
            background-color: var(--azul);
            color: white;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            margin: 0;
            flex: 1;
            text-align: center;
            border-right: 1px solid var(--azulTexto);
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .tab:last-child {
            border-right: none;
        }

        .tab:hover {
            background-color: var(--azulOscuro);
        }

        .tab.active {
            background-color: var(--tabActivo);
            font-weight: bold;
        }

        .sales-report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .sales-report-table th {
            background-color: var(--azulTexto);
            color: white;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }

        .sales-report-table td {
            border: 1px solid #dee2e6;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            color: #555;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        .sales-report-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .sales-report-table tr:hover {
            background-color: #f1f3f5;
        }

        .totals {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: var(--grisOscuro);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn-exportar,
        .btn-imprimir,
        .btn-buscar {
            background-color: var(--azul);
            color: white;
            border: none;
            padding: 12px 30px;
            cursor: pointer;
            margin-left: 15px;
            border-radius: 25px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-exportar:hover,
        .btn-imprimir:hover {
            background-color: var(--azulOscuro);
        }

        .btn-buscar {
            background-color: var(--azulBoton);
            border-radius: 8px;
            margin-top: 25px;
        }

        .btn-buscar:hover {
            background-color: var(--azulBotonHover);
        }
        </style>
    </head>

    <div class="flex flex-col min-h-screen">
        <main class="flex-grow p-6 flex justify-center bg-gray-100">
            <div class="bg-white rounded-lg shadow-lg p-4 w-full mb-20">
                <h3 class="text-3xl font-bold text-gray-800 text-center">
                    {{ __('Reportes de Pedidos') }}
                </h3>

                <div class="reportes-tabs">
                    <button class="tab active" id="pedidos-aceptados">Pedidos Aceptados</button>
                    <button class="tab" id="pedidos-en-preparacion">En Preparación</button>
                    <button class="tab" id="pedidos-en-camino">En Camino</button>
                    <button class="tab" id="pedidos-entregados">Pedidos Entregados</button>
                </div>

                <div id="reportes-container">
                    <table class="sales-report-table">
                        <thead>
                            <tr>
                                <th>Número de Pedido</th>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#12347</td>
                                <td>Carlos López</td>
                                <td>Sushi Variado</td>
                                <td>02/09/2024</td>
                                <td>Aceptado</td>
                                <td>
                                    <button class="btn-buscar"
                                        onclick="cambiarEstado('#12347', 'en-preparacion')">Marcar como En
                                        Preparación</button>
                                    <button class="btn-buscar" onclick="rechazarPedido('#12347')">Rechazar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="totals">
                        <strong>Total Pedidos Aceptados:</strong> 1
                    </div>
                </div>

                <div class="actions">
                    <button class="btn-exportar">Exportar</button>
                    <button class="btn-imprimir">Imprimir</button>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const tabs = document.querySelectorAll(".tab");
                    const reportesContainer = document.getElementById("reportes-container");

                    function updateTable(view) {
                        let tableContent = "";

                        switch (view) {
                            case "pedidos-aceptados":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12347</td>
                                                <td>Carlos López</td>
                                                <td>Sushi Variado</td>
                                                <td>02/09/2024</td>
                                                <td>Aceptado</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="cambiarEstado('#12347', 'en-preparacion')">Marcar como En Preparación</button>
                                                    <button class="btn-buscar" onclick="rechazarPedido('#12347')">Rechazar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;

                            case "pedidos-en-preparacion":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12351</td>
                                                <td>María Gómez</td>
                                                <td>Pizza Margarita</td>
                                                <td>02/09/2024</td>
                                                <td>En Preparación</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="cambiarEstado('#12351', 'en-camino')">Marcar como En Camino</button>
                                                    <button class="btn-buscar" onclick="rechazarPedido('#12351')">Rechazar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;

                            case "pedidos-en-camino":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12352</td>
                                                <td>Juan Pérez</td>
                                                <td>Hamburguesa</td>
                                                <td>02/09/2024</td>
                                                <td>En Camino</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="cambiarEstado('#12352', 'entregado')">Marcar como Entregado</button>
                                                    <button class="btn-buscar" onclick="rechazarPedido('#12352')">Rechazar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;

                            case "pedidos-entregados":
                                tableContent = `
                                    <table class="sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>Número de Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12353</td>
                                                <td>Lucía Martínez</td>
                                                <td>Ensalada Caesar</td>
                                                <td>02/09/2024</td>
                                                <td>Entregado</td>
                                                <td>
                                                    <button class="btn-buscar" onclick="verDetalles('#12353')">Ver Detalles</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>`;
                                break;
                        }

                        reportesContainer.innerHTML = tableContent +
                            '<div class="totals"><strong>Total Pedidos ' + view.replace(/-/g, ' ').replace(
                                /(\w)/, (c) => c.toUpperCase()) + ':</strong> 1</div>';
                    }

                    tabs.forEach(tab => {
                        tab.addEventListener("click", () => {
                            tabs.forEach(t => t.classList.remove(
                            "active")); // Elimina la clase activa de todas las pestañas
                            tab.classList.add(
                            "active"); // Agrega la clase activa a la pestaña actual
                            updateTable(tab.id);
                        });
                    });

                    // Inicializa la tabla con la vista por defecto
                    updateTable(tabs[0].id);
                });
                </script>
            </div>
        </main>
    </div>
</x-app-layout>