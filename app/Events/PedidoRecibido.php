<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PedidoRecibido
{
    use Dispatchable, SerializesModels;

    public $detalle;
    public $fecha;

    public function __construct($detalle, $fecha)
    {
        $this->detalle = $detalle;
        $this->fecha = $fecha;
    }
}
