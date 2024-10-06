<?php

namespace App\Http\Controllers;

use App\Events\PedidoRecibido;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{


    public function index()
    {
        // Puedes mantener este método si quieres cargar la vista inicial con todos los pedidos
       
        return view('pedidos.index');
    }
    
    public function listarPedidos()
    {
        $listapedido = Pedido::all(); // Todos los pedidos
        $pedidosPendiente = Pedido::where('estado', 'pendiente')->get(); // Filtrar por estado
        $pedidosEnCamino = Pedido::where('estado', 'en_camino')->get(); // Filtrar por estado
        $pedidosEntregado = Pedido::where('estado', 'entregado')->get(); // Filtrar por estado
    
        return response()->json([
            'listapedido' => $listapedido,
            'pedidosPendiente' => $pedidosPendiente,
            'pedidosEnCamino' => $pedidosEnCamino,
            'pedidosEntregado' => $pedidosEntregado,
        ]);
    }
    












    





    // setInterval()
    public function store(Request $request)
    {
        // Crea el pedido en la base de datos
        $pedido = Pedido::create([
            'cliente_id' => $request->cliente_id,
            'restaurante_id' => $request->restaurante_id,
            'repartidor_id' => $request->repartidor_id,
            'direccion_entrega_id' => $request->direccion_entrega_id,
            'estado' => 'pendiente',
            'fecha_pedido' => now(),
            'metodo_pago_id' => $request->metodo_pago_id,
        ]);

        // Dispara el evento que notificará al restaurante
        event(new PedidoRecibido($pedido));
    }


    public function cambiarEstado($id)
    {
        $pedido = Pedido::find($id);

        if ($pedido) {
            // Cambia el estado del pedido
            $pedido->estado = 'en_camino'; // Cambia el estado según tu lógica de negocio
            $pedido->save();

            return response()->json(['mensaje' => 'El estado del pedido ha sido actualizado.']);
        } else {
            return response()->json(['mensaje' => 'Pedido no encontrado.'], 404);
        }
    }
    


        // Obtener la cantidad de notificaciones (pedidos pendientes)
        public function obtenerPedidosPendientes()
        {
            $notificaciones = Pedido::where('estado', 'pendiente')->count(); // Ejemplo básico
            return response()->json(['notificaciones' => $notificaciones]);
        }
        

        public function getNotificaciones()
        {
            // Obtiene el número de pedidos con estado 'pendiente'
            $notificaciones = Pedido::where('estado', 'pendiente')->count();
            return response()->json(['notificaciones' => $notificaciones]);
        }



    

  








}