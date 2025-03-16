<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

                    <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <h2 class="text-lg font-bold text-blue-500">Distribuição de Valores</h2>
                        <canvas id="graficoPizza" style="max-width: 200px; max-height: 200px;"></canvas>

                    </div>
                    <a href="{{ route('meus-clientes', Auth::user()->id) }}" class="block">
                        <div
                            class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-blue-100 transition duration-200 cursor-pointer">
                            <h2 class="text-lg font-bold text-blue-500">Nro de Clientes Cadastrados:</h2>
                            <p class="mt-2 text-gray-600">{{ count($clientes) }}</p>
                        </div>
                    </a>
                    <a href="{{ route('user.index') }}" class="block">
                        <div
                            class="bg-white border-2 border-green-200 rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-green-100 transition duration-200 cursor-pointer">
                            <h2 class="text-lg font-bold text-green-500">Nro de Usuarios Cadastrados:</h2>
                            <p class="mt-2 text-gray-600">{{ count($users) }}</p>
                        </div>
                    </a>
                 </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('graficoPizza').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Categoria A (25%)", "Categoria B (40%)", "Categoria C (35%)"],
                    datasets: [{
                        data: [25, 40, 35], // Percentuais
                        backgroundColor: ["#FF6384", "#36A2EB",
                        "#FFCE56"], // Cores para cada segmento
                    }]
                }
            });
        });
    </script>


</x-app-layout>
