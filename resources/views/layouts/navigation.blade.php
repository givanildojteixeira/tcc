<nav x-data="{ open: false }"
    class="div-rodape bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 print:hidden">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}">
                    <img src="/images/guara.png" alt="Logo" class="w-20 h-12">
                </a>

                <!-- Navegação Principal -->
                <div class="hidden sm:flex space-x-4">

                    {{-- Dashboard --}}
                    @acessoGerente
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </x-nav-link>
                    @else
                    <x-nav-link :href="'#'" :disabled="true">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </x-nav-link>
                    @endacessoGerente

                    {{-- Novos --}}
                    <x-nav-link :href="route('veiculos.novos.limparFiltros')"
                        :active="request()->routeIs('veiculos.novos.index')">
                        <i class="fas fa-car mr-2"></i> Novos
                    </x-nav-link>

                    {{-- Usados --}}
                    <x-nav-link :href="route('veiculos.usados.limparFiltros')"
                        :active="request()->routeIs('veiculos.usados.index')">
                        <i class="fas fa-car-crash mr-2"></i> Usados
                    </x-nav-link>

                    {{-- Propostas --}}
                    <x-nav-link :href="route('propostas.index')" :active="request()->routeIs('propostas.index')">
                        <i class="fas fa-file-signature mr-2"></i> Propostas
                    </x-nav-link>

                    {{-- Financeiro --}}
                    @acessoAssistente()
                    <x-nav-link :href="route('financeiro.index')" :active="request()->routeIs('financeiro.index')">
                        <i class="fas fa-wallet mr-2"></i> Financeiro
                    </x-nav-link>
                    @else
                    <x-nav-link :href="'#'" :disabled="true">
                        <i class="fas fa-wallet mr-2"></i> Financeiro
                    </x-nav-link>
                    @endacessoAssistente

                    {{-- Relatórios --}}
                    <x-nav-link :href="route('relatorios.index')" :active="request()->routeIs('relatorios.index')">
                        <i class="fas fa-chart-line mr-2"></i> Relatórios
                    </x-nav-link>
                </div>
            </div>

            <!-- Dropdowns à Direita -->
            <div class="hidden sm:flex items-center space-x-4">
                <!-- Cadastros -->
                <x-dropdown align="left" width="64">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            <i class="fas fa-cogs mr-2"></i> Cadastros
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0
                                    111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Itens Diretos -->
                        <x-dropdown-link :href="route('clientes.index')">
                            <i class="fa-solid fa-people-group mr-2"></i> Clientes
                        </x-dropdown-link>
                        
                        @acessoAssistente()
                        <x-dropdown-link :href="route('familia.index')">
                            <i class="fa-solid fa-car mr-2"></i> Famílias
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('opcionais.index')">
                            <i class="fa-solid fa-toolbox mr-2"></i> Opcionais
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('cores.index')">
                            <i class="fa-solid fa-palette mr-2"></i> Cores
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('condicao_pagamento.index')">
                            <i class="fa-solid fa-money-check-dollar mr-2"></i> Condições de Pagamento
                        </x-dropdown-link>
                        

                        <!-- Submenu Veículos -->
                        <div x-data="{ open: false }" class="relative group">
                            <button @mouseenter="open = true" @mouseleave="open = true"
                                class="flex w-full items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fa-solid fa-car-side mr-2"></i> Veículos
                                <svg class="ml-auto h-4 w-4 transform group-hover:rotate-90 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Submenu Dropdown -->
                            <div x-show="open" @mouseleave="open = false"
                                class="absolute top-0 left-full mt-0 ml-2 min-w-max bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50">

                                <!-- Novos + Cadastro -->
                                <div class="group relative">
                                    <a href="{{ route('veiculos.create', ['from' => 'novos']) }}"
                                        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i class="fas fa-plus-circle"></i><span>Cadastrar Novo</span>
                                    </a>
                                </div>

                                <!-- Usados + Cadastro -->
                                <div class="group relative">
                                    <a href="{{ route('veiculos.create', ['from' => 'usados']) }}"
                                        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i class="fas fa-plus-circle"></i><span>Cadastrar Usado</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        @endacessoAssistente
                    </x-slot>
                </x-dropdown>


                <!-- Usuário -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            <i class="fas fa-user mr-2"></i> {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0
                                    111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fa-solid fa-user-tie mr-2"></i> Meus Dados
                        </x-dropdown-link>
                        @acessoAdmin()
                        <x-dropdown-link :href="route('user.index')">
                            <i class="fa-solid fa-users mr-2"></i> Lista de Usuários
                        </x-dropdown-link>
                        <!-- Link para o GitHub -->
                        <a href="https://github.com/givanildojteixeira/tcc" target="_blank"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <i class="fa-brands fa-github mr-2"></i> Repositório Git
                        </a>
                        @endacessoAdmin
                        <hr class="border-gray-200 dark:border-gray-600 my-2">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa-solid fa-person-walking-arrow-right mr-2"></i> Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Toggle -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition">
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

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <!-- Repetir os demais links aqui se quiser -->
        </div>

        <!-- Mobile - Usuário -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Meus Dados</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Sair
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>