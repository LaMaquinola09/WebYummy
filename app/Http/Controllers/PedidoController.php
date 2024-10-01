<?php

namespace App\Http\Controllers;

use App\Events\PedidoRecibido;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all(); // O tu lógica para obtener pedidos
        $notificaciones = Pedido::where('estado', 'pendiente')->count(); // Pedidos pendientes

        return view('pedidos.index', compact('pedidos', 'notificaciones'));
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
}
