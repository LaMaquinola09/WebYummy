<nav x-data="{ open: false }" class="bg-orange-500 dark:bg-orange-500 border-b border-orange-600 dark:border-gray-700">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="container shrink-0 flex items-center mx-auto justify-between">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('img/Logo_Blanco__1.png') }}" alt="YUMMY" class="block w-auto h-10 mr-3"/>
                        <span class="text-white text-lg font-semibold">YUMMY</span>
                    </a>
                    <!-- Navigation Links -->

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('Registrosolicitud')" :active="request()->routeIs('restaurants')" class="text-white hover:text-yellow-400">
                            {{ __('Solicitud de registro de restaurantes') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-white">
                    {{ __('Solicitud de registro de restaurantes') }}
                </x-responsive-nav-link>
        </div>
    </div>
</nav>
