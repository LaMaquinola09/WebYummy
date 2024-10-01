<?php

namespace App\Listeners;

use App\Events\PedidoRecibido;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EnviarNotificacionPedido implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(PedidoRecibido $event)
    {
        broadcast(new PedidoRecibido($event->detalle, $event->fecha));
    }
}
