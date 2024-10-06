<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Pedido;

class HeaderComposer
{
    public function compose(View $view)
    {
        $notificaciones = Pedido::where('estado', 'pendiente')->count();
        $pedidos = Pedido::where('estado', 'pendiente')->get();

        $view->with('notificaciones', $notificaciones)
             ->with('pedidos', $pedidos);
    }

    private function obtenerNotificaciones()
    {
        // Obtener el número de pedidos pendientes
        return Pedido::where('estado', 'pendiente')->count();
    }
    
}
