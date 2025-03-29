<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 ">
    <!-- Primary Navigation Menu -->
    <!-- <div class="div-navegador  mx-auto px-4 sm:px-6 lg:px-8" style="background-image: url('/images/parede.jpg');"> -->
    <div class="div-navegador mx-auto px-4 sm:px-6 lg:px-8 print:hidden">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <!-- <x-application-logo alt="Logo" class="w-20 h-20" /> -->
                        <img src="/images/guara.png" alt="Logo" class="w-20 h-12">
                    </a>
                </div>

                <!-- Navigation Links Simples-->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i> <!-- Ícone de Dashboard -->
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('veiculos.novos.limparFiltros')" :active="request()->routeIs('veiculos.novos.index')">
                        <i class="fas fa-car mr-2"></i>
                        {{ __('Veículos Novos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('veiculos.usados.limparFiltros')" :active="request()->routeIs('veiculos.usados.index')">
                        <i class="fas fa-car-crash mr-2"></i>
                        {{ __('Veículos Usados') }}
                    </x-nav-link>

                    <x-nav-link :href="route('propostas.index')" :active="request()->routeIs('propostas.index')">
                        <i class="fas fa-file-signature mr-2"></i>
                        {{ __('Propostas') }}
                    </x-nav-link>

                    <x-nav-link :href="route('financeiro.index')" :active="request()->routeIs('financeiro.index')">
                        <i class="fas fa-wallet mr-2"></i>
                        {{ __('Financeiro') }}
                    </x-nav-link>

                    <x-nav-link :href="route('relatorios.index')" :active="request()->routeIs('relatorios.index')">
                        <i class="fas fa-chart-line mr-2"></i>
                        {{ __('Relatórios') }}
                    </x-nav-link>
                </div>
            </div>


            <!-- Agrupa os Dropdowns de Cadastros e Usuário -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                <!-- Dropdown Cadastros -->
                <x-dropdown align="left" width="48" >
                    <x-slot name="trigger">
                        <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-transparent focus:outline-none transition ease-in-out duration-150">
                        <i class="fas fa-cogs mr-2"></i>
                        <div>Cadastros</div>
                        <div class="ms-1">
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
                        <x-dropdown-link :href="route('cliente.create')" class="items-center">
                            <i class="fa-solid fa-people-group"></i>
                            <span class="ms-3">{{ __('Clientes') }}</span>
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('user.index')" class="items-center">
                            <i class="fa-solid fa-car"></i>
                            <span class="ms-3">{{ __('Veículos') }}</span>
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('user.index')" class="items-center">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="ms-3">{{ __('Opcionais') }}</span>
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- Dropdown Usuário -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-transparent focus:outline-none transition ease-in-out duration-150">
                            <i class="fas fa-user mr-2"></i>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
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
                        <x-dropdown-link :href="route('profile.edit')" class="items-center">
                            <i class="fa-solid fa-user-tie"></i>
                            <span class="ms-3">{{ __('Meus Dados') }}</span>
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('user.index')" class="items-center">
                            <i class="fa-solid fa-users"></i>
                            <span class="ms-3">{{ __('Lista de Usuários') }}</span>
                        </x-dropdown-link>

                        <hr class="border-gray-200 dark:border-gray-600 my-2">

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="items-center">
                                <i class="fa-solid fa-person-walking-arrow-right"></i>
                                <span class="ms-3">{{ __('Sair') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
