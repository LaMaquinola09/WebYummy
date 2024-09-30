<x-app-layout>
    @include('header.header')
    <!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reportes de Ventas de Comida - Yummy</title>

        <style>
        :root {
            --azul: #FC924A;
            --azulOscuro: #F98231;
            --azulTexto: #003366;
            /* Color del texto */
            --azulBoton: #4CAF50;
            /* Color del botón Buscar */
            --azulBotonHover: #3d9929;
            /* Color del botón al pasar el cursor */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #6c757d;
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
            background-color: #003366;
            /* Fondo de las pestañas */
            border-radius: 8px;
            /* Bordes redondeados */
            overflow: hidden;
            margin-top: 25px
            /* Para que los bordes redondeados funcionen */
        }

        .tab {
            background-color: var(--azul);
            /* Color de fondo de las pestañas */
            color: white;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            margin: 0;
            flex: 1;
            /* Cada pestaña ocupa el mismo espacio */
            text-align: center;
            border-right: 1px solid #003366;
            /* Línea divisoria entre pestañas */
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .tab:last-child {
            border-right: none;
            /* Elimina el borde de la última pestaña */
        }

        .tab:hover {
            background-color: var(--azulOscuro);
            /* Color al pasar el cursor */
        }

        .tab.active {
            background-color: var(--azul);
            /* Color de la pestaña activa */
            font-weight: bold;
            /* Texto en negrita para la pestaña activa */
        }

        .filter-form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }

        .filter-field {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 150px;
            margin-right: 15px;
        }

        .filter-field label {
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--azulTexto);
        }

        .filter-field select,
        .filter-field input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            transition: border-color 0.3s ease;
        }

        .filter-field input:focus,
        .filter-field select:focus {
            border-color: var(--azul);
            outline: none;
        }

        .sales-report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .sales-report-table th,
        .sales-report-table td {
            border: 1px solid #dee2e6;
            padding: 15px;
            text-align: center;
            font-size: 16px;
        }

        .sales-report-table th {
            background-color: var(--azul);
            color: white;
            font-weight: bold;
        }

        .sales-report-table tr:nth-child(even) {
            background-color: #ffe4e1;
        }

        .sales-report-table tr:hover {
            background-color: #fff5f0;
        }

        .totals {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
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
        .btn-imprimir:hover,
        .btn-buscar:hover {
            background-color: var(--azulOscuro);
        }

        .btn-buscar {
            background-color: var(--azulBoton);
            border-radius: 8px;
            margin-top: 25px;
            /* Alinea el botón con los campos de entrada */
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
                    {{ __('Reportes') }}
                </h3>

                <div class="reportes-tabs">
                    <button class="tab active" id="ventas-clientes">Ventas por clientes</button>
                    <button class="tab" id="ventas-productos">Ventas por productos</button>
                    <button class="tab" id="ventas-categorias">Ventas por categorías</button>
                    <button class="tab" id="ventas-fechas">Ventas por fechas</button>
                </div>


                <form class="filter-form">
                    <div class="filter-field">
                        <label for="cliente">Cliente</label>
                        <select id="cliente">
                            <option value="todos">TODOS</option>
                            <option value="cliente1">Cliente 1</option>
                            <option value="cliente2">Cliente 2</option>
                        </select>
                    </div>

                    <div class="filter-field">
                        <label for="fecha-inicial">Fecha</label>
                        <input type="date" id="fecha-inicial" />
                    </div>

                    <div class="filter-field">
                        <label for="fecha-final">Fecha final</label>
                        <input type="date" id="fecha-final" />
                    </div>

                    <button type="submit" class="btn-buscar">Buscar</button>
                </form>


                <div id="reportes-container">
                    <table class="sales-report-table">
                        <thead>
                            <tr>
                                <th>Punto de venta</th>
                                <th>Nombre</th>
                                <th>Venta cliente</th>
                                <th>Costo</th>
                                <th>Utilidad</th>
                                <th>Venta Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sucursal Centro</td>
                                <td>Tacos al Pastor</td>
                                <td>$60.00</td>
                                <td>$30.00</td>
                                <td>$30.00</td>
                                <td>$60.00</td>
                            </tr>
                            <tr>
                                <td>Sucursal Norte</td>
                                <td>Pizza Margarita</td>
                                <td>$545.00</td>
                                <td>$300.00</td>
                                <td>$245.00</td>
                                <td>$545.00</td>
                            </tr>
                            <tr>
                                <td>Sucursal Sur</td>
                                <td>Ensalada César</td>
                                <td>$150.00</td>
                                <td>$90.00</td>
                                <td>$60.00</td>
                                <td>$150.00</td>
                            </tr>
                            <tr>
                                <td>Sucursal Este</td>
                                <td>Burger Deluxe</td>
                                <td>$300.00</td>
                                <td>$180.00</td>
                                <td>$120.00</td>
                                <td>$300.00</td>
                            </tr>
                            <tr>
                                <td>Sucursal Oeste</td>
                                <td>Sushi Variado</td>
                                <td>$450.00</td>
                                <td>$270.00</td>
                                <td>$180.00</td>
                                <td>$450.00</td>
                            </tr>
                            <tr>
                                <td colspan="6">No se encontraron registros.</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="totals">
                        <strong>Totales:</strong> $1,605.00
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
                            case "ventas-clientes":
                                tableContent = `
                                <table class="sales-report-table">
                                    <thead>
                                        <tr>
                                            <th>Punto de venta</th>
                                            <th>Nombre</th>
                                            <th>Venta cliente</th>
                                            <th>Costo</th>
                                            <th>Utilidad</th>
                                            <th>Venta Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sucursal Centro</td>
                                            <td>Tacos al Pastor</td>
                                            <td>$60.00</td>
                                            <td>$30.00</td>
                                            <td>$30.00</td>
                                            <td>$60.00</td>
                                        </tr>
                                        <tr>
                                            <td>Sucursal Norte</td>
                                            <td>Pizza Margarita</td>
                                            <td>$545.00</td>
                                            <td>$300.00</td>
                                            <td>$245.00</td>
                                            <td>$545.00</td>
                                        </tr>
                                        <tr>
                                            <td>Sucursal Sur</td>
                                            <td>Ensalada César</td>
                                            <td>$150.00</td>
                                            <td>$90.00</td>
                                            <td>$60.00</td>
                                            <td>$150.00</td>
                                        </tr>
                                        <tr>
                                            <td>Sucursal Este</td>
                                            <td>Burger Deluxe</td>
                                            <td>$300.00</td>
                                            <td>$180.00</td>
                                            <td>$120.00</td>
                                            <td>$300.00</td>
                                        </tr>
                                        <tr>
                                            <td>Sucursal Oeste</td>
                                            <td>Sushi Variado</td>
                                            <td>$450.00</td>
                                            <td>$270.00</td>
                                            <td>$180.00</td>
                                            <td>$450.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                `;
                                break;

                            case "ventas-productos":
                                tableContent = `
                                <table class="sales-report-table">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Producto</th>
                                            <th>Unidades Vendidas</th>
                                            <th>Total Vendido</th>
                                            <th>Costo Total</th>
                                            <th>Utilidad Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tacos al Pastor</td>
                                            <td>20</td>
                                            <td>$1,200.00</td>
                                            <td>$600.00</td>
                                            <td>$600.00</td>
                                        </tr>
                                        <tr>
                                            <td>Pizza Margarita</td>
                                            <td>30</td>
                                            <td>$1,635.00</td>
                                            <td>$900.00</td>
                                            <td>$735.00</td>
                                        </tr>
                                        <tr>
                                            <td>Ensalada César</td>
                                            <td>15</td>
                                            <td>$750.00</td>
                                            <td>$450.00</td>
                                            <td>$300.00</td>
                                        </tr>
                                        <tr>
                                            <td>Burger Deluxe</td>
                                            <td>25</td>
                                            <td>$1,500.00</td>
                                            <td>$900.00</td>
                                            <td>$600.00</td>
                                        </tr>
                                        <tr>
                                            <td>Sushi Variado</td>
                                            <td>18</td>
                                            <td>$1,620.00</td>
                                            <td>$1,080.00</td>
                                            <td>$540.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                `;
                                break;

                            case "ventas-categorias":
                                tableContent = `
                                <table class="sales-report-table">
                                    <thead>
                                        <tr>
                                            <th>Categoría</th>
                                            <th>Ventas Totales</th>
                                            <th>Costo Total</th>
                                            <th>Utilidad Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Comidas Mexicanas</td>
                                            <td>$1,200.00</td>
                                            <td>$600.00</td>
                                            <td>$600.00</td>
                                        </tr>
                                        <tr>
                                            <td>Comidas Italianas</td>
                                            <td>$1,635.00</td>
                                            <td>$900.00</td>
                                            <td>$735.00</td>
                                        </tr>
                                        <tr>
                                            <td>Ensaladas</td>
                                            <td>$750.00</td>
                                            <td>$450.00</td>
                                            <td>$300.00</td>
                                        </tr>
                                        <tr>
                                            <td>Hamburguesas</td>
                                            <td>$1,500.00</td>
                                            <td>$900.00</td>
                                            <td>$600.00</td>
                                        </tr>
                                        <tr>
                                            <td>Sushi</td>
                                            <td>$1,620.00</td>
                                            <td>$1,080.00</td>
                                            <td>$540.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                `;
                                break;

                            case "ventas-fechas":
                                tableContent = `
                                <table class="sales-report-table">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Total Vendido</th>
                                            <th>Costo Total</th>
                                            <th>Utilidad Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01/09/2024</td>
                                            <td>$300.00</td>
                                            <td>$200.00</td>
                                            <td>$100.00</td>
                                        </tr>
                                        <tr>
                                            <td>02/09/2024</td>
                                            <td>$450.00</td>
                                            <td>$300.00</td>
                                            <td>$150.00</td>
                                        </tr>
                                        <tr>
                                            <td>03/09/2024</td>
                                            <td>$600.00</td>
                                            <td>$400.00</td>
                                            <td>$200.00</td>
                                        </tr>
                                        <tr>
                                            <td>04/09/2024</td>
                                            <td>$800.00</td>
                                            <td>$500.00</td>
                                            <td>$300.00</td>
                                        </tr>
                                        <tr>
                                            <td>05/09/2024</td>
                                            <td>$1,000.00</td>
                                            <td>$700.00</td>
                                            <td>$300.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                `;
                                break;
                        }

                        reportesContainer.innerHTML = tableContent;
                    }

                    tabs.forEach(tab => {
                        tab.addEventListener("click", () => {
                            tabs.forEach(t => t.classList.remove("active"));
                            tab.classList.add("active");
                            updateTable(tab.id);
                        });
                    });

                    updateTable("ventas-clientes"); // Cargar por defecto las ventas por clientes
                });
                </script>
            </div>
        </main>
    </div>

    </html>
</x-app-layout>