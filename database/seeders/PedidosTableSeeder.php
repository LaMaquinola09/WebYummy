<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar múltiples registros de pedidos
        DB::table('pedidos')->insert([
            [
                'cliente_id' => 13, // ID de un cliente existente
                'restaurante_id' => 1, // ID de un restaurante existente
                'repartidor_id' => 15, // ID de un repartidor existente (puede ser nulo)
                'direccion_entrega_id' => 1, // ID de una dirección existente
                'estado' => 'pendiente',
                'fecha_pedido' => now(), // Fecha actual
                'metodo_pago_id' => 1, // ID de un método de pago existente
            ],
            [
                'cliente_id' => 13,
                'restaurante_id' => 3,
                'repartidor_id' => null, // Sin repartidor asignado
                'direccion_entrega_id' => 1,
                'estado' => 'en_camino',
                'fecha_pedido' => now()->subDays(1), // Un día atrás
                'metodo_pago_id' => 1,
            ],
            [
                'cliente_id' => 16,
                'restaurante_id' => 4,
                'repartidor_id' => 15,
                'direccion_entrega_id' => 1,
                'estado' => 'entregado',
                'fecha_pedido' => now()->subDays(2), // Dos días atrás
                'metodo_pago_id' => 1,
            ],
        ]);
    }
}
