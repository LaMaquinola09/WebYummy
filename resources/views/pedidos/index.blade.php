<x-app-layout>
    @include('header.header')

    <!doctype html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lista de Pedidos - Yummy</title>
        <link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>
        <div class="flex flex-col min-h-screen">
            <main class="flex-grow p-6 flex justify-center bg-gray-100">
                <div class="bg-white rounded-lg shadow-lg p-4 w-full mb-20">
                    <h3 class="text-3xl font-bold text-gray-800 text-center">
                        {{ __('Lista de Pedidos') }}
                    </h3>

                    <!-- Tabs para filtrar los pedidos -->
                    <div class="reportes-tabs">
                        <button class="tab active" id="pedidos-aceptados">Listas de Aceptados</button>
                        <button class="tab" id="pedidos-en-preparacion">En Preparación</button>
                        <button class="tab" id="pedidos-en-camino">En Camino</button>
                        <button class="tab" id="pedidos-entregados">Pedidos Entregados</button>
                    </div>

                    <!-- Contenedor de reportes de pedidos -->
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
                            <tbody id="pedidos-body">
                                <!-- Aquí se llenará dinámicamente con jQuery -->
                            </tbody>
                        </table>

                        <div class="totals">
                            <strong>Total Pedidos Aceptados:</strong> <span id="total-pedidos-aceptados"></span>
                        </div>
                    </div>

                    <!-- Acciones adicionales -->
                    <div class="actions">
                        <button class="btn-exportar">Exportar</button>
                        <button class="btn-imprimir">Imprimir</button>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const tabs = document.querySelectorAll(".tab");
                            const pedidosBody = document.getElementById("pedidos-body");
                            const totalPedidosAceptados = document.getElementById("total-pedidos-aceptados");

                            // Función para cargar pedidos desde el servidor
                            function cargarPedidos(estado = null) {
                                $.get('/api/pedidos', function(data) {
                                    // Limpiar el cuerpo de la tabla
                                    pedidosBody.innerHTML = "";

                                    let pedidos = data.pedidosAceptados; // Por defecto, obtener todos los pedidos

                                    // Filtrar por estado si se proporciona
                                    if (estado) {
                                        pedidos = data[`pedidos${estado.charAt(0).toUpperCase() + estado.slice(1)}`]; // usa el estado pasado
                                    }

                                    // Llenar la tabla con pedidos filtrados
                                    pedidos.forEach(function(pedido) {
                                        const clienteNombre = pedido.cliente ? pedido.cliente.nombre : 'Cliente no disponible';
                                        const row = `<tr>
                                            <td>${pedido.id}</td>
                                            <td>${clienteNombre}</td>
                                            <td>${pedido.producto}</td>
                                            <td>${new Date(pedido.fecha_pedido).toLocaleDateString()}</td>
                                            <td>${pedido.estado}</td>
                                            <td>
                                                <button class="btn-buscar" onclick="cambiarEstado('${pedido.id}', 'en_preparacion')">Marcar como En Preparación</button>
                                                <button class="btn-buscar" onclick="rechazarPedido('${pedido.id}')">Rechazar</button>
                                            </td>
                                        </tr>`;
                                        pedidosBody.innerHTML += row;
                                    });

                                    // Actualizar total de pedidos aceptados
                                    totalPedidosAceptados.textContent = data.pedidosAceptados.length;
                                });
                            }

                            // Cargar todos los pedidos al inicio
                            cargarPedidos();

                            // Manejar el cambio de pestaña
                            tabs.forEach(tab => {
                                tab.addEventListener("click", () => {
                                    tabs.forEach(t => t.classList.remove("active"));
                                    tab.classList.add("active");
                                    const estado = tab.id.replace('pedidos-', ''); // Obtener el estado a partir del id
                                    cargarPedidos(estado === 'aceptados' ? null : estado); // Cargar pedidos según la pestaña
                                });
                            });
                        });

                        // Función para cambiar el estado de un pedido
                        function cambiarEstado(pedidoId, nuevoEstado) {
                            $.ajax({
                                url: `/api/pedidos/${pedidoId}/cambiar-estado`,
                                type: 'PUT',
                                data: {
                                    estado: nuevoEstado
                                },
                                success: function(response) {
                                    alert(`Pedido ${pedidoId} marcado como ${nuevoEstado}.`);
                                    // Recargar pedidos después de cambiar el estado
                                    cargarPedidos(); // Recargar todos los pedidos para reflejar el cambio
                                },
                                error: function(error) {
                                    alert(`Error al cambiar el estado del pedido: ${error.responseJSON.mensaje}`);
                                }
                            });
                        }

                        // Función para rechazar un pedido
                        function rechazarPedido(pedidoId) {
                            alert(`Pedido ${pedidoId} ha sido rechazado.`);
                            // Aquí puedes agregar lógica para eliminar el pedido o cambiar su estado
                        }
                    </script>
                </div>
            </main>
        </div>
    </body>
    </html>
</x-app-layout>
