<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .table th {
            background-color: #4CAF50;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #ddd;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
            text-align: right;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Reporte de Ventas</h1>
    <p><strong>Fecha:</strong> 7 de octubre de 2024</p>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sushi Rolls</td>
                <td>30</td>
                <td>$8.00</td>
                <td>$240.00</td>
            </tr>
            <tr>
                <td>Pizzas</td>
                <td>20</td>
                <td>$12.00</td>
                <td>$240.00</td>
            </tr>
            <tr>
                <td>Bebidas</td>
                <td>50</td>
                <td>$2.00</td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>Postres</td>
                <td>15</td>
                <td>$5.00</td>
                <td>$75.00</td>
            </tr>
        </tbody>
    </table>
    <div class="total">
        <p>Total Ventas: $655.00</p>
    </div>
    <div class="footer">
        <p>&copy; 2024 Mi Restaurante. Todos los derechos reservados.</p>
    </div>
</div>

</body>
</html>
