<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Pedidos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Reportes de Pedidos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Restaurante</th>
                <th>Repartidor</th>
                <th>Estado</th>
                <th>Fecha del Pedido</th>
                <th>Método de Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->cliente ? $pedido->cliente->nombre : 'Sin Repartidor' }}</td>
                <td>{{ $pedido->restaurantes ? $pedido->restaurantes->nombre : 'Sin Restaurante' }}</td>
                <td>{{ $pedido->repartidor ? $pedido->repartidor->nombre : 'Sin Repartidor' }}</td>
                <td>{{ ucfirst($pedido->estado) }}</td>
                <td>{{ $pedido->fecha_pedido }}</td>
                <td>{{ $pedido->metodoPago->nombre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
