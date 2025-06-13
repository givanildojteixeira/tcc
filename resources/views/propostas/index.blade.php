<x-app-layout>
    <!-- Modal de Aprovação -->
    <div x-data="proposta()">
        <div x-show="showModalAprovar" @keydown.escape.window="showModalAprovar = false" style="display: none;"
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 ">
            <div class="bg-white rounded-md shadow-lg p-6 w-full max-w-6xl overflow-y-auto max-h-[90vh] border-t-4 border-green-500 animate-shake relative">
                <button @click="showModalAprovar = false"
                    class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">
                    &times;
                </button>
                <template x-if="conteudoAprovar">
                    <div x-html="conteudoAprovar"></div>
                </template>
            </div>
        </div>
        <!-- Cabeçalho e filtros -->
        <div class="grid grid-cols-6 items-center gap-4 px-4 py-4 bg-white shadow rounded-md border">
            <!-- Título -->
            <form method="GET" action="{{ route('propostas.index') }}"
                class="col-span-8 flex flex-wrap gap-2 items-center">
                <h2 class="text-xl font-semibold text-green-700 col-span-2 min-w-[160px]">
                    Gerenciar Propostas
                </h2>

                <!-- Filtros -->
                <select name="status" onchange="this.form.submit()" class="border px-3 py-2 rounded-md w-48 shrink-0">
                    <option value="">Status (todos)</option>
                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="aprovada" {{ request('status') == 'aprovada' ? 'selected' : '' }}>Aprovada</option>
                    <option value="faturada" {{ request('status') == 'faturada' ? 'selected' : '' }}>Faturada</option>
                    <option value="rejeitada" {{ request('status') == 'rejeitada' ? 'selected' : '' }}>Rejeitada
                    </option>
                    <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>Cancelada
                    </option>
                </select>

                <input type="text" name="busca" value="{{ request('busca') }}"
                    placeholder="Buscar por cliente, veículo, Numero ou vendedor"
                    class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 min-w-[180px]" />

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-search"></i> Buscar
                </button>

                @if (request()->hasAny(['busca', 'status']))
                    <a href="{{ route('propostas.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition flex items-center gap-1">
                        <i class="fas fa-broom"></i> Limpar
                    </a>
                @endif

                <!-- Botão Nova Proposta -->
                <div class="col-span-2 text-right">
                    <a href="{{ route('propostas.limparECreate', ['aba' => 'veiculo']) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                        + Nova Proposta
                    </a>
                </div>
            </form>
        </div>


        <!-- Tabela de Propostas -->
        <div class="w-full max-w-full px-4 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <table class="w-full table-fixed">
                    <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                        <tr class="text-center">
                            <th class="w-1/4 px-4 py-3 text-center">Proposta</th>
                            <th class="w-1/2 px-4 py-3 text-center">Cliente</th>
                            <th class="w-1/2 px-4 py-3 text-center">Veículo</th>
                            <th class="w-1/3 px-4 py-3 text-center">Status</th>
                            <th class="w-1/3 px-4 py-3 text-center">Valor</th>
                            <th class="w-1/3 px-4 py-3 text-center">Vendedor</th>
                            <th class="w-1/4 px-4 py-3 text-center">Data</th>
                            <th class="w-1/2 px-4 py-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach ($propostas as $proposta)
                            <tr class="hover:bg-gray-100 border-t h-14">
                                <td class="px-4 py-2 text-center">{{ $proposta->id }}</td>
                                <td class="px-4 py-2">{{ $proposta->cliente->nome ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $proposta->veiculoNovo->desc_veiculo ?? '-' }}</td>

                                @php
                                    $status = strtolower($proposta->status);
                                    $statusConfig = [
                                        'pendente' => [
                                            'class' => 'bg-yellow-100 text-yellow-800',
                                            'icon' => 'fas fa-clock',
                                        ],
                                        'aprovada' => [
                                            'class' => 'bg-green-100 text-green-800',
                                            'icon' => 'fas fa-check-circle',
                                        ],
                                        'faturada' => [
                                            'class' => 'bg-blue-100 text-blue-800',
                                            'icon' => 'fas fa-file-invoice-dollar',
                                        ],
                                        'rejeitada' => [
                                            'class' => 'bg-red-100 text-red-800',
                                            'icon' => 'fas fa-times-circle',
                                        ],
                                        'cancelada' => [
                                            'class' => 'bg-gray-200 text-gray-700',
                                            'icon' => 'fas fa-ban',
                                        ],
                                    ];

                                    $config = $statusConfig[$status] ?? [
                                        'class' => 'bg-gray-100 text-gray-800',
                                        'icon' => 'fas fa-question-circle',
                                    ];
                                @endphp

                                <td class="px-4 py-2 text-center">
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded {{ $config['class'] }}">
                                        <i class="{{ $config['icon'] }}"></i>
                                        {{ ucfirst($proposta->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-green-700 font-medium text-right">
                                    {{ number_format($proposta->negociacoes->sum('valor'), 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-2">{{ $proposta->usuario->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">
                                    {{ \Carbon\Carbon::parse($proposta->data_proposta)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-2">
                                        {{-- Visualizar --}}
                                        <a href="{{ route('propostas.visualizar', $proposta->id) }}" target="_blank"
                                            title="Visualizar"
                                            class="px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm flex items-center justify-start">
                                            <i class="fas fa-eye w-4 h-4"></i>
                                        </a>

                                        {{-- Editar ou Faturada --}}
                                        @if ($proposta->status === 'Faturada')
                                            <x-modal-info titulo="Proposta faturada não pode ser editada"
                                                mensagem="Esta proposta já foi faturada e não pode mais ser editada."
                                                icone="fas fa-ban" cor="yellow">
                                                <x-slot:trigger>
                                                    <button @click="show = true"
                                                        class="px-3 py-1.5 bg-yellow-400 text-white rounded text-sm cursor-not-allowed opacity-70 flex items-center justify-start">
                                                        <i class="fas fa-lock w-4 h-4"></i>
                                                    </button>
                                                </x-slot:trigger>
                                            </x-modal-info>
                                        @else
                                            <a href="{{ route('propostas.editar', $proposta->id) }}" title="Editar"
                                                class="px-3 py-1.5 bg-yellow-400 text-white rounded hover:bg-yellow-700 text-sm flex items-center justify-start">
                                                <i class="fas fa-edit w-4 h-4"></i>
                                            </a>
                                        @endif

                                        {{-- Aprovar --}}
                                        @acessoAssistente()
                                            @if ($proposta->status === 'Faturada')
                                                <x-modal-info titulo="Proposta faturada."
                                                    mensagem="Esta proposta já foi faturada." icone="fas fa-ban"
                                                    cor="green">
                                                    <x-slot:trigger>
                                                        <button @click="show = true"
                                                            class="px-3 py-1.5 bg-green-600 text-white rounded text-sm cursor-not-allowed opacity-70 flex items-center justify-start">
                                                            <i class="fas fa-lock w-4 h-4"></i>
                                                        </button>
                                                    </x-slot:trigger>
                                                </x-modal-info>
                                            @else
                                                <a href="#" title="Aprovar"
                                                    @click.prevent="abrirModalAprovar({{ $proposta->id }})"
                                                    class="px-3 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 text-sm flex items-center justify-start">
                                                    <i class="fas fa-check-circle w-4 h-4"></i>
                                                </a>
                                            @endif
                                        @endacessoAssistente

                                        {{-- Excluir --}}
                                        @acessoDiretor()
                                            @if ($proposta->status === 'Faturada')
                                                <x-modal-info titulo="Proposta faturada não pode ser excluída."
                                                    mensagem="Esta proposta já foi faturada e não pode mais ser excluída."
                                                    icone="fas fa-ban" cor="red">
                                                    <x-slot:trigger>
                                                        <button @click="show = true"
                                                            class="px-3 py-1.5 bg-red-600 text-white rounded text-sm cursor-not-allowed opacity-70 flex items-center justify-start">
                                                            <i class="fas fa-lock w-4 h-4"></i>
                                                        </button>
                                                    </x-slot:trigger>
                                                </x-modal-info>
                                            @else
                                                <x-modal-excluir :id="$proposta->id" :action="route('propostas.destroy', $proposta->id)" :registro="'Proposta #' . $proposta->id">
                                                    <x-slot:trigger>
                                                        <button @click="show = true"
                                                            class="px-3 py-1.5 bg-red-600 text-white rounded hover:bg-red-700 text-sm flex items-center justify-start"
                                                            title="Excluir">
                                                            <i class="fas fa-trash-alt w-4 h-4"></i>
                                                        </button>
                                                    </x-slot:trigger>
                                                </x-modal-excluir>
                                            @endif
                                        @endacessoDiretor
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($propostas->isEmpty())
                            <tr>
                                <td colspan="8" class="px-4 py-4 text-center text-gray-500">Nenhuma proposta
                                    encontrada.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br>
                <br>
                <br>


                <x-rodape>
                    <div class="font-medium">Total de propostas: {{ $propostas->total() }}</div>
                    <div class="pagination">{{ $propostas->links() }}</div>
                    <div class="flex flex-wrap gap-1 items-center">
                        <span class="font-medium">Cadastro de Propostas</span>
                    </div>
                </x-rodape>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('proposta', () => ({
                conteudoAprovar: '',
                showModalAprovar: false,
                showModalObservacao: false,
                showModalAprovadores: false,
                showModalExcluir: false,
                showModalFaturar: false,
                aprovadores: {
                    gerencial: '',
                    financeira: '',
                    banco: '',
                    diretoria: '',
                },

                abrirModalAprovar(id) {
                    fetch(`/propostas/aprovar/${id}`)
                        .then(res => res.text())
                        .then(html => {
                            this.conteudoAprovar = html;
                            this.showModalAprovar = true;
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Erro ao carregar a proposta.');
                        });
                },

                carregarAprovadores(id) {
                    fetch(`/propostas/${id}/aprovadores`)
                        .then(res => res.json())
                        .then(data => {
                            this.aprovadores = data;
                            this.showModalAprovadores = true;
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Erro ao carregar aprovadores.');
                        });
                },

                alterarCampoProposta(id, chave, valor) {
                    fetch(`/propostas/alterar/${id}/${chave}/${valor}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.showModalAprovar = false;
                                alert(`Campo '${chave}' alterado para '${valor}' com sucesso.`);
                                window.location.reload();
                            } else {
                                alert(data.message || 'Erro ao alterar proposta.');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Erro na requisição.');
                        });
                },

                faturarProposta(id) {
                    fetch(`/propostas/faturar/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.showModalAprovar = false;
                                // alert('Proposta faturada e veículo marcado como vendido.');
                                window.location.reload();
                            } else {
                                alert('Erro ao faturar proposta.');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Erro na requisição.');
                        });
                },

                aprovarGerencialmente(id) {
                    fetch(`/propostas/aprovarGerencialmente/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.showModalAprovar = false;
                                alert('Proposta aprovada pelo gerente.');
                                window.location.reload();
                            } else {
                                alert('Erro ao aprovar proposta.');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Erro na requisição de aprovação grencial.');
                        });
                }

            }));
        });
    </script>
</x-app-layout>
