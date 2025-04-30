<x-app-layout>
    <div x-data="{ aba: '{{ session('aba', 'veiculo') }}' }" class="max-w-6xl mx-auto p-6 bg-white rounded shadow">

        <!-- Título com botão de ajuda -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-green-700">Proposta de Venda</h2>
            <x-bt-ajuda />
        </div>

        <!-- Abas -->
        <div class="flex bg-gray-100 rounded-md overflow-hidden shadow-sm mb-6 font-bold text-sm">
            <button @click="aba = 'veiculo'" :class="aba === 'veiculo'
                ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner'
                : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-car mr-1"></i> 1. Veículo Novo
            </button>

            <button @click="aba = 'cliente'" :class="aba === 'cliente'
                ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner'
                : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-user mr-1"></i> 2. Cliente
            </button>

            <button @click="aba = 'usado'" :class="aba === 'usado'
                ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner'
                : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-car-side mr-1"></i> 3. Veículo Usado
            </button>

            <button @click="aba = 'negociacao'" :class="aba === 'negociacao'
                ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner'
                : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-handshake mr-1"></i> 4. Negociação
            </button>

            <button @click="aba = 'observacoes'" :class="aba === 'observacoes'
                ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner'
                : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-sticky-note mr-1"></i> 5. Observações
            </button>

            <button @click="aba = 'resumo'" :class="aba === 'resumo'
                ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner'
                : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-clipboard-check mr-1"></i> 6. Resumo
            </button>
        </div>


        <!-- Conteúdo de cada aba -->
        <div x-show="aba === 'veiculo'" class="space-y-4">
            @include('propostas.partials.aba-veiculo')
        </div>


        <div x-show="aba === 'cliente'" class="space-y-4">
            @include('propostas.partials.aba-cliente')
        </div>

        <div x-show="aba === 'usado'" class="space-y-4">
            @include('propostas.partials.aba-usado')
        </div>

        <div x-show="aba === 'negociacao'" class="space-y-4">
            @include('propostas.partials.aba-negociacao')
        </div>

        <div x-show="aba === 'observacoes'" class="space-y-4">
            @include('propostas.partials.aba-observacoes')
        </div>

        <div x-show="aba === 'resumo'" class="space-y-4">
            @include('propostas.partials.aba-resumo')
        </div>
    </div>
    <!-- Rodapé -->
    <x-rodape>
        <div class="font-medium">Propostas</div>

        <!-- Legenda de cores -->
        <div class="flex flex-wrap gap-1 items-center">
            Perfil do Usuario => <strong>{{ Auth::user()->level}}</strong>
        </div>
    </x-rodape>
    {{-- Modal de Ajuda --}}
    @include('propostas.partials.modal-ajuda')


    <script>
        window.idClienteSessao = @json(session('proposta.id_cliente'));
    
        document.addEventListener('alpine:init', () => {

            Alpine.data('veiculoNovo', () => ({
                chassiBusca: '',
                veiculos: [],
                veiculo: null,
    
                buscarVeiculo() {
                    if (this.chassiBusca.trim() === '') {
                        alert('Informe o chassi para buscar!');
                        return;
                    }
    
                    fetch(`/api/veiculos/buscar-chassi/${this.chassiBusca}`)
                        .then(res => res.json())
                        .then(data => {
                            this.veiculos = data;
                            if (data.length === 1) {
                                this.veiculo = data[0];
                                this.salvarVeiculoSession(data[0].id);
                            }
                        });
                },
    
                selecionarVeiculo(v) {
                    this.veiculo = v;
                    this.veiculos = [];
                    this.salvarVeiculoSession(v.id);
                },
    
                carregarVeiculoSession() {
                    fetch(`/propostas/veiculo-session`)
                        .then(res => res.json())
                        .then(data => {
                            if (data) {
                                this.veiculo = data;
                            }
                        });
                },
    
                salvarVeiculoSession(id) {
                    fetch(`/propostas/veiculo-session`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id_veiculoNovo: id })
                    });
                }
            }));
    
            Alpine.data('clienteBusca', () => ({
                busca: '',
                clientes: [],
                clienteSelecionado: null,
    
                buscarClientes() {
                    if (this.busca.trim() === '') {
                        alert('Digite um nome ou CPF!');
                        return;
                    }
    
                    fetch(`/api/clientes/buscar/${encodeURIComponent(this.busca)}`)
                        .then(res => res.json())
                        .then(data => {
                            this.clientes = data;
                            if (data.length === 0) alert('Nenhum cliente encontrado');
                        })
                        .catch(() => alert('Erro na busca'));
                },
    
                selecionarCliente(cliente) {
                    this.clienteSelecionado = cliente;
                    this.clientes = [];
    
                    fetch('/propostas/adicionar-cliente', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id_cliente: cliente.id })
                    });
                },
    
                carregarClienteSessao() {
                    if (window.idClienteSessao) {
                        fetch(`/api/clientes/${window.idClienteSessao}`)
                            .then(res => res.json())
                            .then(cliente => {
                                console.log('🔵 Cliente carregado da sessão:', cliente);
                                this.clienteSelecionado = cliente;
                            })
                            .catch(() => {
                                console.warn('Cliente da sessão não encontrado.');
                            });
                    }
                }
            }));
    
            Alpine.data('veiculoUsado', () => ({
                modoCadastro: false,
                modalCadastroUsado: false,
                chassiBusca: '',
                veiculoEncontrado: null,
    
                buscarVeiculo() {
                    if (this.chassiBusca.trim() === '') {
                        alert('Digite o chassi para buscar!');
                        return;
                    }
    
                    fetch(`/api/veiculos-usados/buscar-chassi/${this.chassiBusca}`)
                        .then(res => res.json())
                        .then(data => {
                            this.veiculoEncontrado = data;
                        })
                        .catch(() => {
                            alert('Veículo não encontrado!');
                            this.veiculoEncontrado = null;
                        });
                },
    
                cadastrarVeiculoUsado() {
                    fetch('/propostas/adicionar-veiculo-usado', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({id_veiculo_usado: data.id })
                    })


                    // fetch('/propostas/adicionar-cliente', {
                    //     method: 'POST',
                    //     headers: {
                    //         'Content-Type': 'application/json',
                    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    //     },
                    //     body: JSON.stringify({ id_cliente: cliente.id })
                    // });


                    .then(response => {
                        if (response.ok) {
                            alert('✅ Veículo usado adicionado à proposta!');
                            this.modalCadastroUsado = false;
                            this.resetarFormulario();
                        } else {
                            alert('⚠️ Erro ao adicionar o veículo usado.');
                        }
                    })
                    .catch(() => alert('⚠️ Erro ao comunicar com o servidor.'));
                },
    
                carregarVeiculoViaURL() {
                    const url = new URL(window.location.href);
                    const veiculoId = url.searchParams.get("id_veic_usado");

                    console.log('1. URL detectada:', url.href);
                    
                    if (veiculoId) {
                        console.log('2. ID do veículo usado na URL:', veiculoId);
                        fetch(`/api/veiculos/${veiculoId}`)
                            .then(res => {
                                console.log('3. Requisição para /api/veiculos/' + veiculoId, res);
                                return res.json();
                            })
                            .then(data => {
                                console.log('4. Veículo carregado:', data);
                                this.veiculoEncontrado = data;

                                fetch('/propostas/inserir-veiculo-usado', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        id_veiculo_usado: data.id
                                    })
                                }).then(() => {
                                    console.log('5. Veículo salvo na session.');

                                    const novaUrl = new URL(window.location.href);
                                    novaUrl.searchParams.delete("id_veic_usado");
                                    window.history.replaceState({}, document.title, novaUrl.pathname);
                                    console.log('6. URL limpa:', novaUrl.pathname);
                                });
                            })
                            .catch(error => {
                                console.error('❌ Erro ao buscar veículo:', error);
                            });

                            //Abre a aba de veiculo usado
                            let root = document.querySelector('[x-data*="aba"]');
                            if (root && root.__x && root.__x.$data) {
                                root.__x.$data.aba = 'usado';
                            }
                            console.log('7. Aba "veículo usado" ativada');
                    }
                }

            }));
    
            Alpine.data('negociacao', () => ({
                nova: {
                    condicao: '',
                    valor: '',
                    vencimento: ''
                },
                negociacoes: [],
    
                adicionar() {
                    if (!this.nova.condicao || !this.nova.valor || !this.nova.vencimento) {
                        alert('Preencha todos os campos da negociação!');
                        return;
                    }
    
                    const texto = document.querySelector(`select[x-model='nova.condicao'] option:checked`)?.textContent || '---';
    
                    this.negociacoes.push({
                        condicao: this.nova.condicao,
                        condicao_texto: texto,
                        valor: parseFloat(this.nova.valor),
                        vencimento: this.nova.vencimento
                    });
    
                    this.nova = { condicao: '', valor: '', vencimento: '' };
                },
    
                remover(index) {
                    this.negociacoes.splice(index, 1);
                },
    
                formatarValor(valor) {
                    return 'R$ ' + parseFloat(valor).toFixed(2).replace('.', ',');
                }
            }));
        });
    </script>


</x-app-layout>