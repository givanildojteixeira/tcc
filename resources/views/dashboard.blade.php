<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

                    <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <h2 class="text-lg font-bold text-blue-500">Veículos novos e usados</h2>
                        <canvas id="graficoPizza" style="max-width: 200px; max-height: 200px;"></canvas>
                    </div>

                    <a href="{{ route('meus-clientes', Auth::user()->id) }}" class="block">
                        <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-blue-100 transition duration-200 cursor-pointer">
                            <h2 class="text-lg font-bold text-blue-500">Nro de Clientes Cadastrados:</h2>
                            <p class="mt-2 text-gray-600">{{ count($clientes) }}</p>
                        </div>
                    </a>

                    <a href="{{ route('user.index') }}" class="block">
                        <div class="bg-white border-2 border-green-200 rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-green-100 transition duration-200 cursor-pointer">
                            <h2 class="text-lg font-bold text-green-500">Nro de Usuários Cadastrados:</h2>
                            <p class="mt-2 text-gray-600">{{ count($users) }}</p>
                        </div>
                    </a>

                    <a href="{{ route('meus-clientes', Auth::user()->id) }}" class="block">
                        <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-blue-100 transition duration-200 cursor-pointer">
                            <h2 class="text-lg font-bold text-blue-500">Nro de Veículos Cadastrados:</h2>
                            <p class="mt-2 text-gray-600">{{ count($veiculos) }}</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('graficoPizza').getContext('2d');

            var veiculosNovos = {{ $veiculosnovos }};
            var veiculosUsados = {{ $veiculosusados }};

            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Novos", "Usados"],
                    datasets: [{
                        data: [veiculosNovos, veiculosUsados],
                        backgroundColor: ["#36A2EB", "#FF6384"], // Azul para novos, vermelho para usados
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }, // Esconde a legenda externa
                        datalabels: {
                            color: 'white',
                            font: { weight: 'bold', size: 14 },
                            formatter: (value, ctx) => {
                                let label = ctx.chart.data.labels[ctx.dataIndex];
                                return `${label}: ${value}`;
                            }
                        }
                    },
                    // Evento Onclick para Redireciona para a rota correspondente quando clica no grafico
                    onClick: function(evt, elements) {
                        if (elements.length > 0) {
                            var index = elements[0].index;
                            var rotas = [
                                "{{ route('veiculos.novos.index') }}",
                                "{{ route('veiculos.usados.index') }}"
                            ];
                            window.location.href = rotas[index];
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>




</x-app-layout>
