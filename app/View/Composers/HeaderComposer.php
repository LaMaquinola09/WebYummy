<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Pedido;

class HeaderComposer
{
    public function compose(View $view)
    {
        $notificaciones = $this->obtenerNotificaciones(); // Lógica para contar notificaciones
        $pedidos = Pedido::all(); // Obtén todos los pedidos o ajusta según tu necesidad

        // Compartir variables con la vista
        $view->with(compact('notificaciones', 'pedidos'));
    }

    private function obtenerNotificaciones()
    {
        // Obtener el número de pedidos pendientes
        return Pedido::where('estado', 'pendiente')->count();
    }
    
}
