<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Estadísticas</title>
    <style>
        /* Estilos del PDF */
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Reporte de Estadísticas</h1>
    <p>Fecha: {{ now()->format('d/m/Y') }}</p>

    <!-- Tabla de pedidos por estado -->
    <h2>Pedidos por Estado</h2>
    <table>
        <thead>
            <tr>
                <th>Estado</th>
                <th>Total de Pedidos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidosPorEstado as $estado)
                <tr>
                    <td>{{ $estado->estado }}</td>
                    <td>{{ $estado->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabla de pedidos por método de pago -->
    <h2>Pedidos por Método de Pago</h2>
    <table>
        <thead>
            <tr>
                <th>Método de Pago</th>
                <th>Total de Pedidos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidosPorMetodoPago as $metodo)
                <tr>
                    <td>{{ $metodo->metodo_pago_id }}</td> <!-- Aquí puedes hacer join para mostrar el nombre -->
                    <td>{{ $metodo->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Gráfico de pedidos por estado -->
    <h2>Gráfico: Pedidos por Estado</h2>
    <canvas id="chartPedidosEstado" width="400" height="200"></canvas>

    <!-- Gráfico de pedidos por método de pago -->
    <h2>Gráfico: Pedidos por Método de Pago</h2>
    <canvas id="chartPedidosMetodo" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos para el gráfico de pedidos por estado
        var ctxEstado = document.getElementById('chartPedidosEstado').getContext('2d');
        var chartPedidosEstado = new Chart(ctxEstado, {
            type: 'bar',
            data: {
                labels: @json($pedidosPorEstado->pluck('estado')),
                datasets: [{
                    label: 'Total de Pedidos',
                    data: @json($pedidosPorEstado->pluck('total')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Datos para el gráfico de pedidos por método de pago
        var ctxMetodo = document.getElementById('chartPedidosMetodo').getContext('2d');
        var chartPedidosMetodo = new Chart(ctxMetodo, {
            type: 'pie',
            data: {
                labels: @json($pedidosPorMetodoPago->pluck('metodo_pago_id')),
                datasets: [{
                    data: @json($pedidosPorMetodoPago->pluck('total')),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            }
        });
    </script>
</body>
</html>
