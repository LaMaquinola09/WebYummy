<nav x-data="{ open: false }" class="bg-orange-500 dark:bg-orange-500 border-b border-orange-600 dark:border-gray-700">
    <style>
    .btn-warning {
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        color: white;
        background-color: rgb(249 115 22);
        border: none;
        border-radius: 2px;
        transition: background-color 0.3s, transform 0.2s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        white-space: nowrap;
        /* Evitar que el texto se divida en varias líneas */
    }

    .btn-warning:hover {
        background-color: rgb(249 115 22);
        transform: translateY(-2px);
    }

    .btn-warning:active {
        transform: translateY(1px);
    }
    </style>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo and Buttons (in the same container) -->
            <div class="flex items-center justify-between w-full">
                <!-- Logo -->
                <div class="flex items-center">
                @if(Auth::user()->tipo === 'admin')
                    <a href="{{ route('adminDash') }}" class="flex items-center">
                        <img src="{{ asset('img/Logo_Blanco__1.png') }}" alt="Delivery Logo"
                            class="block w-auto h-10 mr-3" />
                        <span class="text-white text-lg font-semibold">YUMMY</span>
                    </a>
                @elseif(Auth::user()->tipo === 'restaurante')
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('img/Logo_Blanco__1.png') }}" alt="Delivery Logo"
                            class="block w-auto h-10 mr-3" />
                        <span class="text-white text-lg font-semibold">YUMMY</span>
                    </a>
                @endif    
                    
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden sm:flex space-x-8 sm:ml-10 items-center">

                        @if(Auth::user()->tipo === 'admin')
                        <x-responsive-nav-link :href="route('restaurantes.index')"
                            :active="request()->routeIs('restaurantes.index')" class="btn btn-warning">
                            {{ __('Restaurantes') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('usuarios.index')"
                            :active="request()->routeIs('usuarios.index')" class="btn btn-warning">
                            {{ __('Usuarios') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('repartidores.index')"
                            :active="request()->routeIs('repartidores.index')" class="btn btn-warning">
                            {{ __('Repartidores') }}
                        </x-responsive-nav-link>
                        <div x-data="{ open: false }">
                            <!-- Botón para abrir el modal -->
                            <x-responsive-nav-link @click="open = true" class="btn btn-warning">
                              Registrar Categoría
                            </x-responsive-nav-link>
                          
                            <!-- Modal -->
                            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                              <!-- Contenido del modal -->
                              <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6 z-50">
                                <div class="text-left">
                                  <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Registrar Categoría</h3>
                                  <div class="mt-2">
                                    <!-- Formulario para registrar la categoría -->
                                    <form action="{{ route('categorias.store') }}" method="POST">
                                      @csrf
                                      <div class="mb-4">
                                        <label for="category_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Categoría:</label>
                                        <input type="text" id="category_name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingresa el nombre de la categoría" required>
                                      </div>
                                      <div class="flex justify-end">
                                        <button @click="open = false" type="button" class="bg-red-500 hover:bg-red-700 hover:text-white text-black font-bold py-2 px-4 rounded mr-2">
                                          Cancelar
                                        </button>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                          Guardar Categoría
                                        </button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endif
                </div>

                <!-- User Profile Dropdown and Logout -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->nombre }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 dark:text-gray-200">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-gray-700 dark:text-gray-200"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                
  
                <!-- Hamburger Menu (For Mobile) -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-gray-600 focus:outline-none focus:bg-gray-600 focus:text-white transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        @if(Auth::user()->tipo === 'admin')
        <x-responsive-nav-link :href="route('restaurantes.index')" :active="request()->routeIs('restaurantes.index')" class="block text-white px-4 py-2">
            {{ __('Restaurantes') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.index')" class="block text-white px-4 py-2">
            {{ __('Usuarios') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('repartidores.index')" :active="request()->routeIs('repartidores.index')" class="block text-white px-4 py-2">
            {{ __('Repartidores') }}
        </x-responsive-nav-link>
        <div x-data="{ open: false }">
            <!-- Botón para abrir el modal -->
            <button @click="open = true" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-300">
              Registrar Categoría
            </button>
          
            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity" aria-labelledby="modal-title" role="dialog" aria-modal="true">
              <!-- Contenido del modal -->
              <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6 z-50">
                <div class="text-left">
                  <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Registrar Categoría</h3>
                  <div class="mt-2">
                    <!-- Formulario para registrar la categoría -->
                    <form action="{{ route('categorias.store') }}" method="POST">
                      @csrf
                      <div class="mb-4">
                        <label for="category_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Categoría:</label>
                        <input type="text" id="category_name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingresa el nombre de la categoría" required>
                      </div>
                      <div class="flex justify-end">
                        <button @click="open = false" type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">
                          Cancelar
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                          Guardar Categoría
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif 

        <!-- Profile and Logout (Mobile) -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->nombre }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="block text-white">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="block text-white"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
    </div>
    
      
</nav>