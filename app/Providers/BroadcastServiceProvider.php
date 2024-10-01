<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::channel('pedidos', function ($user) {
            return true; // Asegúrate de implementar la lógica de autorización si es necesario
        });
    }
}
