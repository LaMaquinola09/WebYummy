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
    
        // Obtener el usuario logueado
        $usuario = auth()->user();
    
        // Obtener el nombre del restaurante asociado al usuario
        $nombreRestaurante = $usuario->restaurante->nombre; // Asegúrate de que la relación esté definida correctamente
    
        // Cargar la vista y pasar los datos a la misma, especificando 'landscape' para la orientación
        $pdf = PDF::loadView('reportes.index', compact('reportes', 'usuario', 'nombreRestaurante'))
                   ->setPaper('a4', 'landscape'); // Configura el tamaño de papel y la orientación
    
        // Mostrar el archivo PDF en el navegador sin descargarlo
        return $pdf->stream('reporte_pedidos.pdf');
    }
    


    public function mostrarReporte()
    {
        // Obtener todos los registros de la tabla pedidos
        $reportes = Pedido::all();
    
        // Obtener el usuario logueado
        $usuario = auth()->user();
    
        // Obtener el nombre del restaurante asociado al usuario
        $nombreRestaurante = $usuario->restaurante->nombre; // Asegúrate de que la relación esté definida correctamente
    
        // Cargar la vista y pasar los datos a la misma, especificando 'landscape' para la orientación
        $pdf = PDF::loadView('reportes.ventas', compact('reportes', 'usuario', 'nombreRestaurante'))
                   ->setPaper('a4', 'landscape'); // Configura el tamaño de papel y la orientación
    
        // Mostrar el archivo PDF en el navegador sin descargarlo
        return $pdf->stream('reporte_pedidos.pdf');
    }








}
