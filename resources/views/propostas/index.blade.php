<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in!") }} --}}
                    <p class="mb-4 text-center">Lista de Propostas</strong></p>
                </div>
                <li class="nav-icon-btn nav-icon-btn-success">
                    <a href="/canal-comunicacao" class="btn btn-primary wiggle">
                        <span class="badge badge-danger" style="color: black;">1</span>
                        <i class="nav-icon fa fa-envelope"></i> MENSAGENS
                    </a>
                </li>
            </div>
        </div>
    </div>
    <x-rodape>
        <!-- Número de veículos listados -->
        <div class="font-medium" id="selectedVehiclesCount">
            Dashboard
        </div>
    </x-rodape>
</x-app-layout>