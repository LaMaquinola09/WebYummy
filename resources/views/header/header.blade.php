<!-- Enlace a Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Enlace a Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<header class="header d-flex justify-content-between align-items-center p-2  text-white" id="idheader">
    <div class="logo-container d-none d-md-flex">
        <img src="{{ asset('images/Logo_Blanco__1.png') }}" alt="Logo" class="logo-img">
        <a href="#"
            class="logo-text">{{ auth()->user()->restaurante ? auth()->user()->restaurante->nombre : __('RESTAURANTE MENÚ') }}</a>
    </div>

    <div class="d-flex justify-content-end align-items-center flex-nowrap">
        <nav class="auth-links d-flex flex-nowrap overflow-auto">
            <a href="{{ route('menu.index') }}" class="auth-link">{{ __('Mi Menú') }}</a>
            <a href="{{ route('pedidos.index') }}" class="auth-link">{{ __('Pedidos') }}</a>
        </nav>

        <div class="dropdown ms-3">
            <!-- Agregamos margen izquierdo -->
            <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Reportes
            </button>
            <ul class="dropdown-menu">
                <li><button class="dropdown-item" type="button">Pedidos</button></li>
                <li><button class="dropdown-item" type="button">Ventas</button></li>
                <!-- <li><button class="dropdown-item" type="button"></button></li> -->
            </ul>
        </div>
    </div>
</header>

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
</style>