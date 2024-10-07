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

                    <!-- Indicador de pestaña activa -->
                    <div id="pestana-activa" class="text-center mb-4">Pestaña Activa: Pedidos Aceptados</div>

                    <!-- Tabs para filtrar los pedidos -->
                    <div class="reportes-tabs mb-4">
                        <button class="tab active" id="listapedidos">Pedidos Aceptados</button>
                        <button class="tab" id="pendiente">En Preparación</button>
                        <button class="tab" id="en_camino">En Camino</button>
                        <button class="tab" id="entregado">Pedidos Entregados</button>
                    </div>

                    <!-- Contenedor de reportes de pedidos -->
                    <div id="reportes-container">
                        <table class="sales-report-table w-full">
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

                        <div class="totals mt-4">
                            <strong>Total Pedidos Aceptados:</strong> <span id="total-pedidos-aceptados">0</span><br>
                            <strong>Total Pedidos En Preparación:</strong> <span id="total-pedidos-en-preparacion">0</span><br>
                            <strong>Total Pedidos En Camino:</strong> <span id="total-pedidos-en-camino">0</span><br>
                            <strong>Total Pedidos Entregados:</strong> <span id="total-pedidos-entregados">0</span>
                        </div>
                    </div>

                    <!-- Acciones adicionales -->
                    <div class="actions mt-4">
                        <button class="btn-exportar">Exportar</button>
                        <button class="btn-imprimir">Imprimir</button>
                    </div>

                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const tabs = document.querySelectorAll(".tab");
                        const pedidosBody = document.getElementById("pedidos-body");
                        const totalPedidosAceptados = document.getElementById("total-pedidos-aceptados");
                        const totalPedidosEnPreparacion = document.getElementById("total-pedidos-en-preparacion");
                        const totalPedidosEnCamino = document.getElementById("total-pedidos-en-camino");
                        const totalPedidosEntregados = document.getElementById("total-pedidos-entregados");
                        const pestanaActiva = document.getElementById("pestana-activa");

                        // Variable para almacenar el estado activo
                        let estadoActivo = "listapedidos";

                        // Función para cargar pedidos desde el servidor
                        function cargarPedidos(estado = null) {
                            $.get('/api/pedidos', function(data) {
                                console.log(data); // Verifica la respuesta

                                // Limpiar el cuerpo de la tabla
                                pedidosBody.innerHTML = "";

                                let pedidos = [];

                                // Determina qué lista de pedidos usar según el estado
                                if (estado) {
                                    switch (estado) {
                                        case "Pendiente":
                                            pedidos = data.pedidosPendiente || [];
                                            break;
                                        case "En_camino":
                                            pedidos = data.pedidosEnCamino || [];
                                            break;
                                        case "Entregado":
                                            pedidos = data.pedidosEntregado || [];
                                            break;
                                        case "Aceptados":
                                        default:
                                            pedidos = data.pedidosAceptados || [];
                                            break;
                                    }
                                } else {
                                    pedidos = data.pedidosAceptados; // Por defecto, obtener pedidos aceptados
                                }

                                // Llenar la tabla con pedidos filtrados
                                pedidos.forEach(function(pedido) {
                                    const clienteNombre = pedido.cliente_id ?
                                        `Cliente ${pedido.cliente_id}` :
                                        'Cliente no disponible';
                                    const row = `<tr>
                                            <td>${pedido.id}</td>
                                            <td>${clienteNombre}</td>
                                            <td>${pedido.producto || 'Producto no disponible'}</td>
                                            <td>${new Date(pedido.fecha_pedido).toLocaleDateString()}</td>
                                            <td>${pedido.estado}</td>
                                            <td>
                                                <button class="btn-buscar" onclick="cambiarEstado('${pedido.id}', 'en_preparacion')">Marcar como En Preparación</button>
                                                <button class="btn-buscar" onclick="rechazarPedido('${pedido.id}')">Rechazar</button>
                                            </td>
                                        </tr>`;
                                    pedidosBody.innerHTML += row;
                                });

                                // Actualizar totales
                                totalPedidosAceptados.textContent = data.pedidosAceptados.length;
                                totalPedidosEnPreparacion.textContent = data.pedidosPendiente.length;
                                totalPedidosEnCamino.textContent = data.pedidosEnCamino.length;
                                totalPedidosEntregados.textContent = data.pedidosEntregado.length;

                                // Volver a establecer la pestaña activa
                                tabs.forEach(tab => tab.classList.remove("active"));
                                document.getElementById(estadoActivo).classList.add("active");
                                pestanaActiva.textContent = `Pestaña Activa: ${document.getElementById(estadoActivo).textContent}`;
                            });
                        }

                        // Cargar pedidos al inicio
                        cargarPedidos();

                        // Actualizar pedidos cada 30 segundos
                        setInterval(() => {
                            cargarPedidos(estadoActivo === "listapedidos" ? null : estadoActivo);
                        }, 20000); // 30 segundos

                        // Manejar el cambio de pestaña
                        tabs.forEach(tab => {
                            tab.addEventListener("click", () => {
                                // Cambiar la pestaña activa
                                tabs.forEach(t => t.classList.remove("active"));
                                tab.classList.add("active");

                                estadoActivo = tab.id; // Almacenar el estado activo

                                const estado = estadoActivo === "listapedidos" ? "Aceptados" : estadoActivo
                                    .charAt(0).toUpperCase() + estadoActivo.slice(1);

                                // Actualizar el indicador de pestaña activa
                                pestanaActiva.textContent = `Pestaña Activa: ${tab.textContent}`;

                                // Cargar pedidos según la pestaña
                                cargarPedidos(estado === "Aceptados" ? null : estado);
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
                                cargarPedidos(estadoActivo); // Recargar según la pestaña activa
                            },
                            error: function(error) {
                                alert(
                                    `Error al cambiar el estado del pedido: ${error.responseJSON.mensaje}`
                                );
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
