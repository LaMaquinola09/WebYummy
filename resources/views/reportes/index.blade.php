<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos - Ordenados</title>
    <style>
    /* ESTILOS GRALES */
    * {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

    .titulos {
        font-size: 15px;
        text-transform: uppercase;
    }

    /* HEADER */
    .div-1Header,
    .div-1Datos {
        width: 100%;
    }

    .logotd {
        width: 50%;
        height: auto;
    }

    .datos-grales-td,
    .receptor {
        width: 50%;
    }

    .table_h_factura {
        width: 100%;
        margin: 0;
        padding: 0;
        background-color: #FFF;
    }

    .headerDatosh {
        text-align: right;
        color: #FFF;
        padding: 5px;
        background-color: rgb(24, 140, 207);
    }

    .table_h_factura tr td p {
        margin: 0;
        padding: 2px;
        text-align: right;
        padding-right: 5px;
    }

    /* DATOS */
    .table_receptor,
    .table_datos {
        width: 100%;
        margin: 0;
        padding: 10px;
        background-color: rgba(243, 243, 243, 0.521);
        border-radius: 5px;
    }

    .table_receptor tr td p {
        margin: 0;
        padding: 2px;
        text-align: left;
    }

    .tituloRec {
        color: rgb(24, 140, 207);
    }

    /* MATERIALES */
    .table_materiales {
        width: 100%;
        margin: 10px 0;
    }

    .table_materiales thead tr {
        background-color: rgb(24, 140, 207);
        color: #FFF;
    }

    .table_materiales thead tr td {
        padding: 5px;
        text-align: center;
        font-size: 14px;
    }

    .table_materiales tr td {
        text-align: center;
        padding: 5px;
        border-bottom: 1px solid rgba(20, 20, 20, 0.096);
    }

    /* DATOS FINALES */
    .table_datosFtxt {
        width: 70%;
        margin: 0;
    }

    .datosFinales {
        width: 30%;
    }

    .datosFinales .table_datosfinales {
        width: 100%;
        margin: 0;
        padding: 10px;
        border: 1px solid rgba(20, 20, 20, 0.096);
    }

    .datosFinales .table_datosfinales tr td p {
        margin: 0;
        padding: 2px;
        text-align: left;
    }

    /* FIRMA */
    .firma {
        border-top: 1px solid rgba(20, 20, 20, 0.5);
        text-align: center;
        width: 30%;
        margin-left: auto;
        margin-top: 80px;
        padding-top: 5px;
    }

    /* FOOTER */
    footer {
        width: 100%;
        text-align: center;
        position: absolute;
        bottom: 0;
    }
    </style>
</head>

<body>
    <!-- HEADER -->
    <table class="div-1Header">
        <tr>
            <td class="logotd">
                <img src="{{ asset(auth()->user()->restaurante->imagen) }}" alt="Logo" class="logo-img">
            </td>
            <td class="datos-grales-td">
                <table class="table_h_factura">
                    <thead>
                        <tr>
                            <th class="headerDatosh titulos">Remisión: <span class="titulos">1</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="titulos">
                                <p class="nombre usuario">{{ $usuario->nombre }}</p> <!-- Nombre del usuario -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Restaurante: <span>{{ $usuario->restaurante->nombre }}</span></p>
                                <!-- Nombre del restaurante -->
                                <img src="{{ asset($usuario->restaurante->imagen) }}" alt="Logo del Restaurante"
                                    style="max-width: 150px; height: auto;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Teléfono: <span>{{ $usuario->telefono }}</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>E-mail: <span>{{ $usuario->email }}</span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <!-- DATOS -->
    <table class="div-1Datos">
        <tr>
            <td class="receptor">
                <table class="table_receptor">
                    <thead>
                        <tr>
                            <th class="titulos">Receptor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>1</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>RFC: <span>3</span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class="datosGral">
                <table class="table_datos">
                    <tbody>
                        <tr>
                            <td>
                                <p>Fecha de creación:</p>
                            </td>
                            <td>
                                <p>122212</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Fecha de vencimiento:</p>
                            </td>
                            <td>
                                <p>21212</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Sucursal:</p>
                            </td>
                            <td>
                                <p>12</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <!-- MATERIAL/PRODUCTO -->
    <table class="table_materiales">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>12345</td>
                <td>Producto 1</td>
                <td>2</td>
                <td>$50.00</td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Producto 2</td>
                <td>1</td>
                <td>$75.00</td>
                <td>$75.00</td>
            </tr>
            <!-- Agregar más filas según sea necesario -->
        </tbody>
    </table>

    <footer>
        <p>Gracias por su compra</p>
    </footer>
</body>

</html>