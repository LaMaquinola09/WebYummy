<x-app-layout>
        @if(Auth::user()->tipo === 'admin')
            <script>
                window.location.replace('{{ route("adminDash") }}')
            </script>
        @endif
    @include('header.header')

    <!-- Contenedor principal del Dashboard -->
    <div class="flex flex-col min-h-screen">
        <!-- Flexbox para toda la pantalla -->
        <main class="flex-grow p-6 flex justify-center bg-gray-100">
            <div class="bg-white rounded-lg shadow-lg p-4 w-full mb-20">
                <h1 class="text-3xl font-bold text-gray-800 text-center">
                    {{ __('Bienvenido al Dashboard de Comida') }}
                </h1>
                <p class="mt-2 text-gray-600 text-center">
                    {{ __("configuraciones y ver las estadísticas.") }}
                </p>

                <!-- Contenido adicional del Dashboard -->
                <div class="mt-4">
                    <div class="row">

                        <!-- Tarjeta Platos Registrados -->
                        <div class="col-xl-3 col-sm-6 mb-4">
                            <div class="card border-l-4 border-blue-500 shadow-md transition-transform transform hover:scale-105"
                                 onclick="this.classList.toggle('expanded')">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-bold text-gray-500">
                                                    Platos Registrados
                                                </p>
                                                <h5 class="font-bold text-2xl text-blue-600">150</h5>
                                                <p class="mb-0">
                                                    <span class="text-success font-bold">+10%</span>
                                                    desde ayer
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="ni ni-basket text-3xl text-white" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Contenedor colapsable con detalles adicionales -->
                                <div class="card-details hidden p-4">
                                    <p>Detalles adicionales sobre los platos...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Ventas Totales -->
                        <div class="col-xl-3 col-sm-6 mb-4">
                            <div class="card border-l-4 border-yellow-500 shadow-md transition-transform transform hover:scale-105"
                                 onclick="this.classList.toggle('expanded')">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-bold text-gray-500">
                                                    Ventas Totales
                                                </p>
                                                <h5 class="font-bold text-2xl text-yellow-600">$103,430</h5>
                                                <p class="mb-0">
                                                    <span class="text-success font-bold">+5%</span>
                                                    Mes Pasado
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="ni ni-money-coins text-3xl text-white"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Contenedor colapsable con detalles adicionales -->
                                <div class="card-details hidden p-4">
                                    <p>Detalles sobre las ventas totales...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Órdenes Pendientes -->
                        <div class="col-xl-3 col-sm-6 mb-4">
                            <div class="card border-l-4 border-orange-500 shadow-md transition-transform transform hover:scale-105"
                                 onclick="this.classList.toggle('expanded')">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-bold text-gray-500">
                                                    Órdenes Pendientes
                                                </p>
                                                <h5 class="font-bold text-2xl text-orange-600">24</h5>
                                                <p class="mb-0">
                                                    <span class="text-danger font-bold">+15%</span>
                                                    Última Hora
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="ni ni-delivery-fast text-3xl text-white"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Contenedor colapsable con detalles adicionales -->
                                <div class="card-details hidden p-4">
                                    <p>Detalles sobre las órdenes pendientes...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Clientes Activos -->
                        <div class="col-xl-3 col-sm-6 mb-4">
                            <div class="card border-l-4 border-teal-500 shadow-md transition-transform transform hover:scale-105"
                                 onclick="this.classList.toggle('expanded')">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-bold text-gray-500">
                                                    Clientes Activos
                                                </p>
                                                <h5 class="font-bold text-2xl text-teal-600">1,800</h5>
                                                <p class="mb-0">
                                                    <span class="text-success font-bold">+15%</span>
                                                    Total de clientes activos
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-teal shadow-teal text-center rounded-circle">
                                                <i class="ni ni-single-02 text-3xl text-white"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Contenedor colapsable con detalles adicionales -->
                                <div class="card-details hidden p-4">
                                    <p>Detalles sobre los clientes activos...</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
    </div>

    <style>
        /* Ocultar detalles inicialmente */
        .card-details {
            display: none;
        }

        /* Mostrar detalles cuando se active la clase 'expanded' */
        .card.expanded .card-details {
            display: block;
        }
    </style>
</x-app-layout>
