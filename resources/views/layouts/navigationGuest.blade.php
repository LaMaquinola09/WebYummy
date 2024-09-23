<nav x-data="{ open: false }" class="bg-orange-500 dark:bg-orange-500 border-b border-orange-600 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="container shrink-0 flex items-center mx-auto justify-between">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('img/Logo_Blanco__1.png') }}" alt="YUMMY" class="block w-auto h-10 mr-3"/>
                        <span class="yummy-brand">YUMMY</span>
                    </a>
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('Registrosolicitud')" :active="request()->routeIs('restaurants')" class="btn-custom">
                            {{ __('Solicitud de registro de restaurantes') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="btn-custom">
                {{ __('Solicitud de registro de restaurantes') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>

<style>
    /* Estilo para la marca "YUMMY" */
    .yummy-brand {
        all: unset; /* Elimina cualquier estilo heredado */
        font-family: 'Poppins', sans-serif; /* Fuente atractiva */
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); /* Sombra para hacer el texto más llamativo */
        letter-spacing: 1.5px; /* Espaciado entre letras */
        transition: color 0.3s ease; /* Efecto de transición suave */
        text-decoration: none; /* Asegura que no haya subrayado */
    }

    .yummy-brand:hover {
        color: #ffd700; /* Cambio de color en hover (dorado) */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4); /* Sombra más profunda al pasar el ratón */
        transform: scale(1.05); /* Efecto de crecimiento en hover */
    }

    /* Estilo personalizado para el botón */
    .btn-custom {
        all: unset; /* Elimina cualquier estilo heredado */
        display: inline-block; /* Se comporta como un botón */
        background: linear-gradient(45deg, #f97316, #f59e0b);
        color: white;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        text-decoration: none; /* Evita que el enlace se subraye */
    }

    .btn-custom:hover {
        background: linear-gradient(45deg, #f59e0b, #f97316);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada */
        transform: translateY(-2px); /* Efecto de elevación en hover */
    }
</style>
