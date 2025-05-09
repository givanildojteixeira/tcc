<x-app-layout>
    <div x-data="{ 
        aba: sessionStorage.getItem('abaAtiva') || '{{ session('aba', 'veiculo') }}',
        init() {
            this.$watch('aba', val => sessionStorage.setItem('abaAtiva', val));
        }
    }" class="flex flex-col overflow-hidden bg-white rounded shadow p-2">
    {{-- }" class="flex flex-col h-[calc(100vh-130px)] overflow-hidden bg-white rounded shadow p-2"> --}}
    

        <!-- Título -->
        <div class="flex justify-between items-center p-1 shrink-0">
            <h2 class="text-2xl font-bold text-green-700">Proposta de Venda</h2>
            <x-bt-ajuda />
        </div>

        <!-- Abas -->
        <div class="flex bg-gray-100 rounded-md shadow-sm mb-2 font-bold text-sm shrink-0 px-6">
            @foreach ([
                'veiculo' => '1. Veículo Novo|fas fa-car',
                'cliente' => '2. Cliente|fas fa-user',
                'usado' => '3. Veículo Usado|fas fa-car-side',
                'negociacao' => '4. Negociação|fas fa-handshake',
                'observacoes' => '5. Observações|fas fa-sticky-note',
                'resumo' => '6. Resumo|fas fa-clipboard-check'
            ] as $key => $labelIcon)
                @php [$label, $icon] = explode('|', $labelIcon); @endphp
                <button @click="aba = '{{ $key }}'" 
                    :class="aba === '{{ $key }}'
                        ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner'
                        : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                    class="flex-1 px-4 py-2 transition-all duration-200">
                    <i class="{{ $icon }} mr-1"></i> {{ $label }}
                </button>
            @endforeach
        </div>

        <!-- Área com scroll interno -->
        <div class="flex-1 px-6 pb-6 flex-1 overflow-hidden">
            <div x-show="aba === 'veiculo'" class="space-y-4">
                @include('propostas.partials.aba-veiculo')
            </div>
            <div x-show="aba === 'cliente'" class="space-y-4">
                @include('propostas.partials.aba-cliente')
            </div>
            <div x-show="aba === 'usado'" class="space-y-4">
                @include('propostas.partials.aba-usado')
            </div>
            <div x-show="aba === 'negociacao'" class="flex flex-col h-full px-6 pb-6 overflow-hidden">
                @include('propostas.partials.aba-negociacao')
            </div>
            <div x-show="aba === 'observacoes'" class="space-y-4">
                @include('propostas.partials.aba-observacoes')
            </div>
            <div x-show="aba === 'resumo'" class="space-y-4">
                @include('propostas.partials.aba-resumo')
            </div>
        </div>
    </div>
    <br><br>

    <!-- Rodapé -->
    <x-rodape>
        <div class="font-medium">Propostas</div>
        <div class="flex flex-wrap gap-1 items-center">
            Perfil do Usuario => <strong>{{ Auth::user()->level}}</strong>
        </div>
    </x-rodape>
    {{-- Modal de Ajuda --}}
    @include('propostas.partials.modal-ajuda')


    <script>
        window.idClienteSessao = @json(session('proposta.id_cliente'));
        window.propostaSessao = @json(session('proposta'));
        window.negociacoesSalvas = @json(session('proposta.negociacoes', []));
    
        document.addEventListener('alpine:init', () => {

            Alpine.data('veiculoNovo', () => ({
                chassiBusca: '',
                veiculos: [],
                veiculo: null,
    
                buscarVeiculo() {
                    if (this.chassiBusca.trim() === '') {
                        alert('Informe o Chassi, Modelo ou Cor para buscar!');
                        return;
                    }
    
                    fetch(`/api/veiculos/buscar-chassi/${this.chassiBusca}`)
                        .then(res => res.json())
                        .then(data => {
                            this.veiculos = data;
                            if (data.length === 1) {
                                this.veiculo = data[0];
                                // TODO: VERIFICAR RETIRAR LINHA ABAIXO
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
                    fetch(`/propostas/inserir-veiculo-novo`)
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
                },

                removerVeiculoNovo() {
                    this.chassiBusca = '',
                    this.veiculos = [],
                    this.veiculo = null,

                    fetch('/propostas/remover-veiculo-novo', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => {
                        if (!res.ok) {
                            alert('Erro ao remover o veículo da sessão.');
                        }
                    }).catch(() => {
                        alert('Erro ao comunicar com o servidor.');
                    });
                },
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
                },
                removerCliente() {
                    this.clienteSelecionado = null;
                    this.clientes = [];
    
                    fetch('/propostas/remover-cliente', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => {
                        if (!res.ok) {
                            alert('Erro ao remover o cliente da sessão.');
                        }
                    }).catch(() => {
                        alert('Erro ao comunicar com o servidor.');
                    });
                }
            }));
    
            Alpine.data('veiculoUsado', () => ({
                modoCadastro: false,
                modalCadastroUsado: false,
                chassiBusca: '',
                veiculoEncontrado: null,
    
                buscarVeiculoUsado() {
                if (this.chassiBusca.trim() === '') {
                    alert('Digite o chassi, placa ou modelo!');
                    return;
                }

                fetch(`/api/veiculos-usados/buscar-chassi/${this.chassiBusca}`)
                    .then(res => res.json())
                    .then(data => {
                        this.veiculoEncontrado = Array.isArray(data) ? data : [data];
                    })
                    .catch(() => {
                        alert('Erro na busca ou nenhum veículo encontrado.');
                        this.veiculoEncontrado = [];
                    });
                },

                selecionarVeiculo(v) {
                    this.veiculo = v;
                    this.veiculoEncontrado = []; // limpa a lista
                    this.cadastrarVeiculoUsado(v.id);
                },

                cadastrarVeiculoUsado(id) {
                    fetch('/propostas/inserir-veiculo-usado', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id_veiculo_usado: id })
                    })
                    .then(response => {
                        if (response.ok) {
                            // alert('✅ Veículo usado adicionado à proposta!');
                            this.modalCadastroUsado = false;
                            // Se desejar limpar algo aqui, pode usar resetarFormulario()
                        } else {
                            alert('⚠️ Erro ao adicionar o veículo usado.');
                        }
                    })
                    .catch(() => alert('⚠️ Erro ao comunicar com o servidor.'));
                },
    
                carregarVeiculoViaURL() {
                    const url = new URL(window.location.href);
                    const veiculoId = url.searchParams.get("id_veic_usado");

                    console.log('🔍 URL detectada:', url.href);

                    if (veiculoId) {
                        console.log('📦 ID do veículo usado na URL:', veiculoId);

                        fetch('/propostas/inserir-veiculo-usado', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id_veiculo_usado: veiculoId
                            })
                        })
                        .then(() => fetch(`/api/veiculos/${veiculoId}`))
                        .then(res => res.json())
                        .then(data => {
                            console.log('🚗 Veículo da URL carregado:', data);
                            this.veiculo = data;
                            this.veiculoEncontrado = [data];

                            const novaUrl = new URL(window.location.href);
                            novaUrl.searchParams.delete("id_veic_usado");
                            window.history.replaceState({}, document.title, novaUrl.pathname);
                            console.log('🧹 URL limpa:', novaUrl.pathname);

                            let root = document.querySelector('[x-data*="aba"]');
                            if (root && root.__x && root.__x.$data) {
                                root.__x.$data.aba = 'usado';
                            }
                        })
                        .catch(err => {
                            console.error('❌ Erro ao processar veículo da URL:', err);
                        });

                    } else {
                        fetch(`/propostas/veiculos-usados-session`)
                        .then(res => res.json())
                        .then(data => {
                            if (data) {
                                this.veiculo = data;
                            }
                        });
                    }
                  
                },

                removerVeiculoUsado(v) {
                    fetch(`/propostas/veiculos-usados-session-remova`)
                        .then(res => res.json())
                        .then(data => {
                            if (data) {
                                this.veiculo = data;
                            }
                        });
                }

            }));
    
            Alpine.data('negociacao', () => ({
                nova: {
                    condicao: '',
                    valor: '',
                    vencimento: new Date().toLocaleDateString('en-CA') // Formato YYYY-MM-DD

                },
                negociacoes: [],
                valorBaseProposta: 0,


                carregaNegociacao() {
                    const sessao = window.propostaSessao || {};
                    const negociacoesSalvas = window.negociacoesSalvas || [];

                    // Carrega negociações anteriores (sem duplicar "Usado(s)")
                    this.negociacoes = negociacoesSalvas.filter(n => n.condicao_texto !== 'Usado(s)');

                    // Valor da proposta
                    if (sessao.valor_veiculoNovo) {
                        this.valorBaseProposta = parseFloat(sessao.valor_veiculoNovo);
                    }

                    // Adiciona "Usado(s)" se necessário
                    if (sessao.valor_veiculoUsado && parseFloat(sessao.valor_veiculoUsado) > 0) {
                        const jaExiste = this.negociacoes.some(n => n.condicao_texto === 'Usado(s)');
                        if (!jaExiste) {
                            this.negociacoes.push({
                                condicao: 14,  // substitua se tiver ID real
                                condicao_texto: 'Usado(s)',
                                valor: parseFloat(sessao.valor_veiculoUsado),
                                vencimento: new Date().toISOString().substr(0, 10),
                                fixo: true
                            });
                        }
                    }
                },

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
    
                    nova = { condicao: '', valor: '', vencimento: '' };
                    this.salvarNegociacoes();

                },
    
                remover(index) {
                    this.negociacoes.splice(index, 1);
                    this.salvarNegociacoes();
                },

                salvarNegociacoes() {
                    fetch('/propostas/negociacoes-session', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            negociacoes: this.negociacoes
                        })
                    });
                },


                get valorTotalProposta() {
                    // Some todos os "acréscimos" à proposta base
                    const acrescimos = this.negociacoes
                        .filter(n => n.condicao_texto === 'Acréscimo(+)' || n.condicao == 'ACRESCIMO')
                        .reduce((acc, n) => acc + parseFloat(n.valor || 0), 0);
                    return this.valorBaseProposta + acrescimos;
                },

                somaNegociacoes() {
                    // Ignora "Acréscimo(+)"
                    return this.negociacoes
                        .filter(n => n.condicao_texto !== 'Acréscimo(+)' && n.condicao != 'ACRESCIMO')
                        .reduce((acc, n) => acc + parseFloat(n.valor || 0), 0);
                },

                diferencaValor() {
                    return this.valorTotalProposta - this.somaNegociacoes();
                },

                formatarValor(valor) {
                    return new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(valor);
                },

                temAcrescimo() {
                    return this.negociacoes.some(n => n.condicao_texto === 'Acréscimo(+)' || n.condicao == 'ACRESCIMO');
                },

                formatarValor(valor) {
                    return new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(valor);
                },

                formatarData(dataISO) {
                    if (!dataISO) return '';
                    const [ano, mes, dia] = dataISO.split('-');
                    return `${dia}/${mes}/${ano}`;
                },

                dataHoje() {
                    return new Date().toLocaleDateString('en-CA');
                },
            }));

            Alpine.data('observacao', () => ({
                nota: window.propostaSessao?.observacao_nota || '',
                interna: window.propostaSessao?.observacao_interna || '',

                carregaObservacao() {
                    this.nota = window.propostaSessao?.observacao_nota || '';
                    this.interna = window.propostaSessao?.observacao_interna || '';
                },

                salvar() {
                    fetch('/propostas/observacoes-session', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            observacao_nota: this.nota,
                            observacao_interna: this.interna
                        })
                    });
                }
            }));


            Alpine.data('resumoProposta', () => ({
                proposta: window.propostaSessao || {},
                veiculo: {},
                veiculoUsado: {},
                valorProposta: 0,
                valorDesconto: 0,
                custoItem: 0,
                valorBonus: 0,
                valorUsado: 0,

                carregaVeiculo() {
                    if (this.proposta.id_veiculoNovo) {
                        fetch(`/api/veiculos/${this.proposta.id_veiculoNovo}`)

                            .then(res => res.json())
                            .then(data => this.veiculo = data)
                            .catch(() => this.veiculo = {});
                    }
                },

                carregaVeiculoUsado() {
                    if (this.proposta.id_veiculo_usado) {
                        fetch(`/api/veiculos/${this.proposta.id_veiculo_usado}`)
                            .then(res => res.json())
                            .then(data => this.veiculoUsado = data)
                            .catch(() => this.veiculoUsado = {});
                    }
                },

                carregaCliente() {
                    if (this.proposta.id_cliente) {
                        fetch(`/api/clientes/${this.proposta.id_cliente}`)
                            .then(res => res.json())
                            .then(data => this.clienteSelecionado = data)
                            .catch(() => this.clienteSelecionado = {});
                    }
                },

                carregaResumoFinanceiro() {
                    // Busca custo, bonus e desconto no banco via ID do veículo
                    if (this.proposta.id_veiculoNovo) {
                        fetch(`/api/veiculos/${this.proposta.id_veiculoNovo}`)
                            .then(res => res.json())
                            .then(data => {
                                this.valorProposta = parseFloat(data.vlr_tabela || 0);
                                this.custoItem = parseFloat(data.vlr_nota || 0);  // <- garanta que esse campo existe
                                this.valorBonus = parseFloat(data.vlr_bonus || 0);     // <- idem
                                this.valorDesconto = parseFloat(data.vlr_desconto || 0); // <- se houver
                            });
                    }

                    // Valor do(s) usado(s) da proposta
                    this.valorUsado = parseFloat(this.proposta.valor_veiculoUsado || 0);
                },

                get lucroEstimado() {
                    return this.valorProposta - this.valorDesconto - this.valorBonus - this.custoItem;
                },


                formatarValor(valor) {
                    return new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(valor || 0);
                },

                formatarData(data) {
                    if (!data) return '';
                    return new Date(data).toLocaleDateString('pt-BR');
                },

                somaNegociacoes(lista) {
                    return (lista || []).reduce((total, item) => {
                        // Exclui condição "Acréscimo(+)" se desejar, senão remova o if
                        if (item.condicao_texto !== 'Acréscimo(+)' && item.condicao != 'ACRESCIMO') {
                            return total + parseFloat(item.valor || 0);
                        }
                        return total;
                    }, 0);
                },
            }));

        });
    </script>


</x-app-layout>