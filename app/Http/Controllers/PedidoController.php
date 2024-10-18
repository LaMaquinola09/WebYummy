<?php

namespace App\Http\Controllers;

use App\Events\PedidoRecibido;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth; // Importar la clase Auth
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PedidoController extends Controller
{


    public function index()
    {
        return view('pedidos.index'); // Vista inicial
    }
    


    public function listarPedidos(): JsonResponse
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar si el usuario tiene un restaurante asociado
        if ($user && $user->restaurante) {
            // Obtener el ID del restaurante asociado al usuario
            $restauranteId = $user->restaurante->id;
    
            // Obtener los pedidos del restaurante asociado al usuario autenticado
            $listapedido = Pedido::where('restaurante_id', $restauranteId)->get();
    
            return response()->json([
                'pedidosAceptados' => $listapedido,
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no tiene un restaurante asociado o no está autenticado.',
            ], 404);
        }
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
        // public function obtenerPedidosPendientes()
        // {
        //     $notificaciones = Pedido::where('estado', 'pendiente')->count(); // Ejemplo básico
        //     return response()->json(['notificaciones' => $notificaciones]);
        // }
        

        // public function getNotificaciones()
        // {
        //     // Obtiene el número de pedidos con estado 'pendiente'
        //     $notificaciones = Pedido::where('estado', 'pendiente')->count();
        //     return response()->json(['notificaciones' => $notificaciones]);
        // }


        // public function getNotificaciones()
        // {
        //     // Obtiene el ID del restaurante del usuario autenticado
        //     $restauranteId = auth()->user()->restaurante->id;

        //     // Obtiene el número de pedidos con estado 'pendiente' para el restaurante del usuario
        //     $notificaciones = Pedido::where('estado', 'pendiente')
        //         ->where('restaurante_id', $restauranteId)
        //         ->count();

        //     return response()->json(['notificaciones' => $notificaciones]);
        // }




        // public function getNotificaciones()
        // {
        //     // Asegúrate de que el usuario tenga un restaurante asociado
        //     if (auth()->user()->restaurante) {
        //         // Obtiene el ID del restaurante del usuario autenticado
        //         $restauranteId = auth()->user()->restaurante->id;

        //         // Obtiene el número de pedidos con estado 'pendiente' para el restaurante del usuario
        //         $notificaciones = Pedido::where('estado', 'pendiente')
        //             ->where('restaurante_id', $restauranteId)
        //             ->count();

        //         return response()->json(['notificaciones' => $notificaciones]);
        //     } else {
        //         // Si el usuario no tiene un restaurante asociado, no mostrar notificaciones
        //         return response()->json(['notificaciones' => 0]);
        //     }
        // }



        public function getNotificaciones()
        {
            // Verificar si el usuario tiene un restaurante asociado
            if (auth()->user()->restaurante) {
                $restauranteId = auth()->user()->restaurante->id;
    
                // Obtener el número de pedidos pendientes para el restaurante del usuario
                $notificaciones = Pedido::where('estado', 'pendiente')
                    ->where('restaurante_id', $restauranteId)
                    ->count();
    
                // Retornar la cantidad de notificaciones en formato JSON
                return response()->json(['notificaciones' => $notificaciones]);
            } else {
                // Si el usuario no tiene un restaurante asociado, retornar 0 notificaciones
                return response()->json(['notificaciones' => 0]);
            }
        }


    

  








}