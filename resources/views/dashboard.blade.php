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

                    {{-- <!-- Gráfico Linha -->
                    <div class="bg-white border-2 border-blue-200 rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <h2 class="text-lg font-bold text-blue-500">Propostas ao Longo do Tempo</h2>
                        <canvas id="graficoLinha" style="max-width: 200px; max-height: 200px;"></canvas>
                    </div> --}}


                    <div
                        class="bg-white border-2 border-indigo-200 rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <h2 class="text-lg font-bold text-indigo-600 mb-4">Propostas por Status</h2>
                        <canvas id="graficoPropostas" class="w-full max-w-xl h-64"></canvas>
                    </div>

                    <div class="bg-white border-2 border-blue-300 rounded-lg shadow-lg p-2">
                        <h2 class="text-xl font-bold text-blue-600 mb-4 text-center">Resumo Geral do Sistema</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">

                            {{-- Clientes --}}
                            <a href="{{ route('clientes.index', Auth::user()->id) }}"
                                class="flex flex-col items-center p-4 border border-blue-300 rounded-xl hover:bg-blue-50 transition shadow-md">
                                👥
                                <h3 class="text-blue-500 font-semibold text-sm mt-2">Clientes</h3>
                                <p class="text-2xl font-bold text-gray-700 mt-1">{{ count($clientes) }}</p>
                            </a>

                            {{-- Usuários --}}
                            <a href="{{ route('dashboard') }}"
                                class="flex flex-col items-center p-4 border border-green-300 rounded-xl hover:bg-green-50 transition shadow-md">
                                🔒
                                <h3 class="text-green-500 font-semibold text-sm mt-2">Usuários</h3>
                                <p class="text-2xl font-bold text-gray-700 mt-1">{{ count($users) }}</p>
                            </a>

                            {{-- Veículos --}}
                            <a href="{{ route('veiculos.novos.index', Auth::user()->id) }}"
                                class="flex flex-col items-center p-4 border border-yellow-300 rounded-xl hover:bg-yellow-50 transition shadow-md">
                                🚗
                                <h3 class="text-yellow-500 font-semibold text-sm mt-2">Veículos</h3>
                                <p class="text-2xl font-bold text-gray-700 mt-1">{{ count($veiculos) }}</p>
                            </a>

                            {{-- Propostas --}}
                            <a href="{{ route('propostas.index', Auth::user()->id) }}"
                                class="flex flex-col items-center p-4 border border-purple-300 rounded-xl hover:bg-purple-50 transition shadow-md">
                                📄
                                <h3 class="text-purple-500 font-semibold text-sm mt-2">Propostas</h3>
                                <p class="text-2xl font-bold text-gray-700 mt-1">{{ count($propostas) }}</p>
                            </a>

                        </div>
                    </div>

                    {{-- finaceiro --}}
                    {{-- Valor a Pagar --}}
                    <a href="{{ route('financeiro.index', Auth::user()->id) }}"
                    class="border-2 border-blue-300 rounded-lg shadow-lg p-2 bg-red-50">
                        <div>
                            <h2 class="text-xl font-bold text-blue-600 mb-4 text-center">Valor à Pagar</h2>
                            <p class="text-2xl font-bold text-gray-800 mt-1 text-center">
                               💳 R$ {{ number_format($valorPagar, 2, ',', '.') }}
                            </p>
                        </div>
                        
                    </a>

                    {{-- Valor a Receber --}}
                    <a href="{{ route('financeiro.receber', Auth::user()->id) }}"
                    class="border-2 border-blue-300 rounded-lg shadow-lg p-2 bg-green-50">
                        <div>
                            <h2 class="text-xl font-bold text-blue-600 mb-4 text-center">Valor à Receber</h2>
                            <p class="text-2xl font-bold text-gray-800 mt-1 text-center">
                                💵 R$ {{ number_format($valorReceber, 2, ',', '.') }}
                            </p>
                        </div>
                        
                    </a>


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


            const ctxPropostas = document.getElementById('graficoPropostas').getContext('2d');

            const propostasChart = new Chart(ctxPropostas, {
                type: 'bar',
                data: {
                    labels: ["Aprovadas", "Pendentes", "Faturadas", "Rejeitadas", "Canceladas"],
                    datasets: [{
                        label: 'Propostas',
                        data: [
                            {{ $propostasAprovadas }},
                            {{ $propostasPendentes }},
                            {{ $propostasFaturadas }},
                            {{ $propostasRejeitadas }},
                            {{ $propostasCanceladas }}
                        ],
                        backgroundColor: ["#4CAF50", "#FACC15", "#3B82F6", "#EF4444", "#9CA3AF"],
                        borderColor: ["#388E3C", "#D97706", "#2563EB", "#B91C1C", "#6B7280"],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0,
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
                            formatter: (value) => `${value}`
                        }
                    },
                    onClick: function(evt, elements) {
                        if (elements.length > 0) {
                            const status = ['Aprovada', 'pendente', 'Faturada', 'rejeitada',
                                'Cancelada'
                            ];
                            const statusSelecionado = status[elements[0].index];
                            const url = `/propostas?status=${statusSelecionado}`;
                            window.location.href = url;
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
