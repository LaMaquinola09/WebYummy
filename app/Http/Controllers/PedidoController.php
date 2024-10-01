<?php

namespace App\Http\Controllers;
use App\Events\PedidoRecibido;
use App\Models\Pedido; // Asegúrate de importar el modelo

use Illuminate\Http\Request;

class PedidoController extends Controller
{



    public function index()
{
    $pedidos = Pedido::all(); // O cualquier otra lógica para obtener los pedidos
    $notificaciones = Pedido::where('estado', 'pendiente')->count(); // Contar pedidos pendientes
    return view('pedidos.index', compact('pedidos', 'notificaciones')); // Asegúrate de incluir 'notificaciones'
}



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