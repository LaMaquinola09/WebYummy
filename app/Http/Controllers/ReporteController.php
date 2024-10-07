<?php

namespace App\Http\Controllers;
use PDF; // Importar el Facade de PDF
use App\Models\Pedido;


use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        // Obtener todos los registros de la tabla pedidos
        $reportes = Pedido::all();
        
        // Cargar la vista y pasar los datos a la misma, especificando 'landscape' para la orientación
        $pdf = PDF::loadView('reportes.index', compact('reportes'))
                   ->setPaper('a4', 'landscape'); // Configura el tamaño de papel y la orientación

        // Mostrar el archivo PDF en el navegador sin descargarlo
        return $pdf->stream('reporte_pedidos.pdf');
    }


    public function generarReporteEstadistica()
    {
        // Obtener las estadísticas de los pedidos
        $pedidosPorEstado = Pedido::selectRaw('estado, COUNT(*) as total')
                            ->groupBy('estado')
                            ->get();

        $pedidosPorMetodoPago = Pedido::selectRaw('metodo_pago_id, COUNT(*) as total')
                                ->groupBy('metodo_pago_id')
                                ->get();

        // Puedes agregar más estadísticas si lo deseas, como ventas por día, etc.

        // Cargar la vista y pasar los datos de estadísticas
        $pdf = PDF::loadView('reportes.estadistica', compact('pedidosPorEstado', 'pedidosPorMetodoPago'))
                  ->setPaper('a4', 'landscape'); // PDF en horizontal

        // Mostrar el PDF en el navegador
        return $pdf->stream('reporte_estadisticas.pdf');
    }









}
