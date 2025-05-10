<x-app-layout>
    <div class="overflow-y-auto h-[calc(100vh-100px)] px-4 py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

                    <!-- Gráfico Pizza 1 -->
                    <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <h2 class="text-lg font-bold text-blue-500">Veículos Novos e Usados (Pizza)</h2>
                        <canvas id="graficoPizza1" style="max-width: 200px; max-height: 200px;"></canvas>
                    </div>

                    <!-- Gráfico Barra -->
                    <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <h2 class="text-lg font-bold text-blue-500">Veículos Novos e Usados (Barra)</h2>
                        <canvas id="graficoBarra" style="max-width: 200px; max-height: 200px;"></canvas>
                    </div>

                    <!-- Gráfico Linha -->
                    <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <h2 class="text-lg font-bold text-blue-500">Propostas ao Longo do Tempo</h2>
                        <canvas id="graficoLinha" style="max-width: 200px; max-height: 200px;"></canvas>
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


                    {{-- repetção --}}

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
                    

                    {{-- re --}}

                </div>
            </div>
        </div>
    </div>
    <x-rodape>
        <!-- Número de veículos listados -->
        <div class="font-medium" id="selectedVehiclesCount">
            Dashboard
        </div>
    </x-rodape>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Gráfico Pizza 1
            var ctx1 = document.getElementById('graficoPizza1').getContext('2d');

            // Corrigir a passagem de dados para o JS
            var veiculosNovos = @json($veiculosnovos);
            var veiculosUsados = @json($veiculosusados);


            var myPieChart1 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ["Novos", "Usados"],
                    datasets: [{
                        data: [veiculosNovos, veiculosUsados],
                        backgroundColor: ["#36A2EB", "#4CAF50"], // Azul e Verde
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: 14
                            },
                            formatter: (value, ctx) => {
                                let label = ctx.chart.data.labels[ctx.dataIndex];
                                return `${label}: ${value}`;
                            }
                        }
                    },
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

            // Gráfico Barra (Vertical)
            var ctx2 = document.getElementById('graficoBarra').getContext('2d');

            var myBarChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ["Novos", "Usados"],
                    datasets: [{
                        label: 'Veículos',
                        data: [veiculosNovos, veiculosUsados],
                        backgroundColor: ["#36A2EB", "#4CAF50"],
                        borderColor: ["#2C6F9E", "#388E3C"],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 20,
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: true,
                                color: '#e5e5e5',
                                lineWidth: 1
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: 14
                            },
                            formatter: (value) => {
                                return `${value}`;
                            }
                        }
                    },
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

            // Gráfico Linha (dados fictícios)
            var ctx3 = document.getElementById('graficoLinha').getContext('2d');

            var myLineChart = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Meses fictícios
                    datasets: [{
                        label: 'Veículos Vendidos',
                        data: [30, 45, 60, 80, 55, 100], // Dados fictícios de veículos vendidos
                        fill: false, // Não preenche a área abaixo da linha
                        borderColor: '#FF6384', // Cor da linha
                        tension: 0.1, // Curvatura da linha
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            color: 'black',
                            font: {
                                weight: 'bold',
                                size: 14
                            },
                            formatter: (value) => {
                                return `${value}`;
                            }
                        }
                    },
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