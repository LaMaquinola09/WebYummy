<!-- Enlace a Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Enlace a Bootstrap Icons CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
<!-- Enlace a Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<header class="header d-flex justify-content-between align-items-center p-2 text-white" id="idheader">
    <div class="logo-container d-none d-md-flex">
        <img src="{{ asset(auth()->user()->restaurante->imagen) }}" alt="Logo" class="logo-img">
        <a href="#" class="logo-text">{{ auth()->user()->restaurante ? auth()->user()->restaurante->nombre : __('RESTAURANTE MENÚ') }}</a>
    </div>

    <div class="d-flex justify-content-end align-items-center flex-nowrap">
        <div class="notification ms-3 position-relative">
            <button class="btn btn-notification p-0" title="Nuevas Notificaciones" data-bs-toggle="modal" data-bs-target="#notificationModal">
                <i class="bi bi-bell-fill text-white fs-4"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                    {{ $notificaciones ?? 0 }}
                </span>
            </button>
        </div>

        <nav class="auth-links d-flex flex-nowrap overflow-auto">
            <a href="{{ route('menu.index') }}" class="auth-link">{{ __('Mi Menú') }}</a>
            <a href="{{ route('pedidos.index') }}" class="auth-link">{{ __('Pedidos') }}</a>
            <a href="{{ route('restaurantes.comentarios', ['id' => auth()->user()->restaurante->id]) }}" class="auth-link">{{ __('Comentarios') }}</a>
            </nav>

        <div class="dropdown ms-3">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Reportes
            </button>
            <ul class="dropdown-menu">
                <li><button class="dropdown-item" type="button">Pedidos</button></li>
                <li><button class="dropdown-item" type="button">Ventas</button></li>
            </ul>
        </div>
    </div>
</header>

<!-- Modal de notificaciones -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Nuevos Pedidos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <ul class="list-group" id="lista-pedidos">
                    @foreach($pedidos as $pedido)
                    @if($pedido->estado == 'pendiente')
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Pedido #{{ $pedido->id }}</strong> - {{ $pedido->descripcion ?? 'Sin descripción' }}
                            <p class="mb-0 text-muted">
                                {{ $pedido->fecha_pedido ? $pedido->fecha_pedido->format('d M Y, H:i') : 'Fecha no disponible' }}
                            </p>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm me-2" onclick="cambiarEstadoPedido({{ $pedido->id }})">Confirmar Pedido</button>
                            <button class="btn btn-danger btn-sm" onclick="rechazarPedido({{ $pedido->id }})">Producto Agotado</button>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Div para mostrar mensajes de notificación -->
<div id="notifications" style="display: none; position: absolute; top: 10px; right: 10px; z-index: 1000;"></div>

<script>
// Mostrar notificación en pantalla
function mostrarNotificacion(mensaje) {
    const notificationsDiv = document.getElementById('notifications');
    const notification = document.createElement('div');
    notification.className = 'alert alert-success';
    notification.innerText = mensaje;
    notificationsDiv.appendChild(notification);
    notificationsDiv.style.display = 'block';

    // Ocultar la notificación después de 3 segundos
    setTimeout(() => {
        notificationsDiv.removeChild(notification);
        if (notificationsDiv.childElementCount === 0) {
            notificationsDiv.style.display = 'none';
        }
    }, 3000);
}

// Cambiar el estado del pedido
function cambiarEstadoPedido(id) {
    fetch(`/api/pedidos/${id}/cambiar-estado`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.mensaje) {
            alert(data.mensaje);
            mostrarNotificacion('¡Su pedido fue aceptado!');
            verificarNotificaciones(); 
        }
    })
    .catch(error => console.error('Error al cambiar el estado del pedido:', error));
}

let notificacionesCount = {{ $notificaciones ?? 0 }}; // Inicializa el contador de notificaciones

// Verificar y actualizar el contador de notificaciones
function verificarNotificaciones() {
    fetch('/api/notificaciones')
        .then(response => response.json())
        .then(data => {
            if (data.notificaciones !== notificacionesCount) {
                let notisOld = document.querySelector('.badge.bg-danger').innerText;
                notificacionesCount = data.notificaciones;
                document.querySelector('.badge.bg-danger').innerText = notificacionesCount;
                if(notisOld < notificacionesCount) {
                    mostrarNotificacion('¡Has recibido un nuevo pedido!');
                } else {
                    
                }
            }
        })
        .catch(error => console.error('Error al verificar notificaciones:', error));
}

// Iniciar la verificación de notificaciones cada 5 segundos
document.addEventListener('DOMContentLoaded', function() {
    setInterval(verificarNotificaciones, 5000);
});
</script>

<style>
.header {
    background-color: #f69143;
}

#idheader {
    background-color: #F87013;
    opacity: 90%;
}

#notifications {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1000;
}

.logo-container {
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.logo-img {
    height: 50px;
    margin-right: 10px;
}

.logo-text {
    font-size: 24px;
    font-weight: bold;
    color: white;
    text-decoration: none;
}

.auth-links {
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.auth-link {
    margin-right: 15px;
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.auth-link:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-toggle {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

.dropdown-menu {
    background-color: #F87013;
}

.dropdown-item {
    color: white;
}

.dropdown-item:hover {
    background-color: #F87013;
}

.notification {
    position: relative;
}

.notification .btn-notification {
    background: none;
    border: none;
    position: relative;
    outline: none;
}

.notification .badge {
    position: absolute;
    top: -5px;
    right: -5px;
}
</style>
