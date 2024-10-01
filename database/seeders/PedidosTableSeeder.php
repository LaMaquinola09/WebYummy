<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Events\PedidoRecibido;

class PedidosTableSeeder extends Seeder
{
    public function run()
    {
        $pedidos = [
            [
                'cliente_id' => 13,
                'restaurante_id' => 1,
                'repartidor_id' => 15,
                'direccion_entrega_id' => 1,
                'estado' => 'pendiente',
                'fecha_pedido' => now(),
                'metodo_pago_id' => 1,
            ],
            [
                'cliente_id' => 13,
                'restaurante_id' => 3,
                'repartidor_id' => null,
                'direccion_entrega_id' => 1,
                'estado' => 'en_camino',
                'fecha_pedido' => now()->subDays(1),
                'metodo_pago_id' => 1,
            ],
            [
                'cliente_id' => 16,
                'restaurante_id' => 4,
                'repartidor_id' => 15,
                'direccion_entrega_id' => 1,
                'estado' => 'entregado',
                'fecha_pedido' => now()->subDays(2),
                'metodo_pago_id' => 1,
            ],
        ];

        foreach ($pedidos as $pedido) {
            // Insertar el pedido
            $nuevoPedido = DB::table('pedidos')->insertGetId($pedido);

            // Emitir el evento
            event(new PedidoRecibido($pedido, now())); // Puedes modificar los parámetros según necesites
        }
    }
}
