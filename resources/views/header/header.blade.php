<!-- Enlace a Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Enlace a Bootstrap Icons CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
    rel="stylesheet">

<!-- Enlace a Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<header class="header d-flex justify-content-between align-items-center p-2 text-white" id="idheader">
    <div class="logo-container d-none d-md-flex">
        <img src="{{ asset('images/Logo_Blanco__1.png') }}" alt="Logo" class="logo-img">
        <a href="#"
            class="logo-text">{{ auth()->user()->restaurante ? auth()->user()->restaurante->nombre : __('RESTAURANTE MENÚ') }}</a>
    </div>







    <div class="d-flex justify-content-end align-items-center flex-nowrap">

        <!-- Icono de notificación con campanita -->
        <div class="notification ms-3 position-relative">
            <button class="btn btn-notification p-0" title="Nuevas Notificaciones" data-bs-toggle="modal"
                data-bs-target="#notificationModal">
                <i class="bi bi-bell-fill text-white fs-4"></i> <!-- Ícono de campana de Bootstrap Icons -->
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                    3
                    <!-- Número estático de notificaciones -->
                </span>
            </button>
        </div>




        <nav class="auth-links d-flex flex-nowrap overflow-auto">
            <a href="{{ route('menu.index') }}" class="auth-link">{{ __('Mi Menú') }}</a>
            <a href="{{ route('pedidos.index') }}" class="auth-link">{{ __('Pedidos') }}</a>
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
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Nuevos Pedidos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se muestran los pedidos con datos estáticos -->
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Pedido #1</strong> - 2 Pizzas y 1 Coca-Cola
                            <p class="mb-0 text-muted">27 Sep 2024, 14:30</p>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm me-2" onclick="aceptarPedido(101)">Confirmar Pedido</button>
                            <button class="btn btn-danger btn-sm" onclick="rechazarPedido(101)">Producto Agotados</button>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Pedido #2</strong> - 3 Sushi Rolls
                            <p class="mb-0 text-muted">27 Sep 2024, 14:32</p>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm me-2" onclick="aceptarPedido(102)">Confirmar Pedido</button>
                            <button class="btn btn-danger btn-sm" onclick="rechazarPedido(102)">Producto Agotados</button>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Pedido #103</strong> - 1 Ensalada Caesar
                            <p class="mb-0 text-muted">27 Sep 2024, 14:35</p>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm me-2" onclick="aceptarPedido(103)">Confirmar Pedido</button>
                            <button class="btn btn-danger btn-sm" onclick="rechazarPedido(103)">Producto Agotados</button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos para el encabezado */
.header {
    background-color: #f69143;
}

#idheader {
    background-color: #F87013;
    opacity: 90%;
}

/* Estilos para el contenedor del logo */
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

/* Estilos para los enlaces de autenticación */
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

/* Estilos para el botón del menú desplegable */
.dropdown-toggle {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

/* Estilos para el menú desplegable */
.dropdown-menu {
    background-color: #F87013;
}

.dropdown-item {
    color: white;
}

.dropdown-item:hover {
    background-color: #F87013;
}

/* Estilos para la notificación */
.notification {
    position: relative;
}

.notification .btn-notification {
    background: none;
    border: none;
    position: relative;
    outline: none;
}

.notification .bi-bell-fill {
    transition: color 0.3s;
}

.notification .bi-bell-fill:hover {
    color: #ffdd57;
}

.notification .badge {
    font-size: 0.75rem;
    line-height: 1;
    min-width: 18px;
    height: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    background-color: #ff3d3d;
    border: 2px solid white;
}
</style>

<script>
function aceptarPedido(pedidoId) {
    // Lógica para aceptar el pedido
    alert('Pedido ' + pedidoId + ' aceptado.');
}

function rechazarPedido(pedidoId) {
    // Lógica para rechazar el pedido
    alert('Pedido ' + pedidoId + ' rechazado.');
}
</script>