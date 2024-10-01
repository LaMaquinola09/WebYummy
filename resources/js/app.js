import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();




import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.channel('pedidos')
    .listen('PedidoRecibido', (e) => {
        console.log('Nuevo pedido recibido:', e.pedido);
        // Aquí puedes actualizar la UI o hacer algo con la notificación
    });
