<x-app-layout>
    <div x-data="{
        editModal: false,
        editUser: {
            id: null,
            name: '',
            level: ''
        }
    }">

        <!-- 🔝 Header -->
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 px-4 h-screen py-4 pb-4">
            <!-- 🟩 Título -->
            <h2 class="text-2xl font-semibold text-green-700">
                Gerenciamento de usuários
            </h2>

            <!-- 🔍 Filtro com botão buscar e limpar -->
            <form method="GET" action="{{ route('user.index') }}" class="flex gap-2 w-full">
                <!-- Campo de texto -->
                <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por nome ou email..."
                    class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />

                <!-- Botão Buscar (verde) -->
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>

                <!-- Botão Limpar -->
                @if(request('busca'))
                <a href="{{ route('user.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-broom"></i>
                    Limpar
                </a>
                @endif
            </form>


            <!-- ➕ Botão novo -->
            <div class="text-right">
                <button @click="showModal = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    + Novo usuário
                </button>
            </div>

        </div>

        <!-- 🧾 Conteúdo com scroll interno -->
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-gray-900 dark:text-gray-100" id="tabela-wrapper">
                        <table class="w-full table-fixed">
                            <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                                <tr class="hover:bg-gray-300">
                                    <th class="text-center">Nível</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Data de cadastro</th>
                                    @can('level')
                                    <th class="text-center">Ações</th>
                                    @endcan
                                </tr>
                            </thead>

                            <body>
                                @foreach ($users as $user)
                                <tr class="hover:bg-gray-100 {{ $user->active ? '' : 'text-gray-400' }}">
                                    <td class="text-center">
                                        @switch($user->level)
                                            @case('admin')
                                                <i class="fa-solid fa-user-shield text-red-600" title="Administrador"></i>
                                                @break
                                    
                                            @case('Vendedor')
                                                <i class="fa-solid fa-cart-shopping text-green-600" title="Vendedor"></i>
                                                @break
                                    
                                            @case('Assistente')
                                                <i class="fa-solid fa-user-pen text-blue-600" title="Assistente"></i>
                                                @break
                                    
                                            @case('Gerente')
                                                <i class="fa-solid fa-user-tie text-yellow-600" title="Gerente"></i>
                                                @break
                                    
                                            @case('Diretor')
                                                <i class="fa-solid fa-briefcase text-purple-600" title="Diretor"></i>
                                                @break
                                    
                                            @default
                                                <i class="fa-solid fa-user text-gray-500" title="Usuário"></i>
                                        @endswitch
                                    </td>
                                    
                                    <td class="p-2">{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->created_at}}</td>

                                    @can('level')
                                    <td class="text-center">
                                        <button 
                                        @click="editModal = true; editUser = {
                                            id: {{ $user->id }},
                                            name: '{{ addslashes($user->name) }}',
                                            email: '{{ addslashes($user->email) }}',
                                            level: '{{ $user->level }}',
                                            active: {{ $user->active ? 'true' : 'false' }}
                                        }"
                                        class="px-3 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 transition text-sm">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Editar
                                    </button>

                                    </td>

                                    @endcan
                                </tr>
                                @endforeach
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-rodape>

            <!-- Número de veículos listados -->
            <div class="font-medium" id="selectedVehiclesCount">
                Total de usuários cadastrados: {{ $users->total() }}
            </div>

            <!-- Paginação -->
            <div class="pagination">
                {{ $users->links() }}
            </div>

            <!-- Legenda de cores -->
            <div class="flex flex-wrap gap-1 items-center">
                Perfil do Usuario => <strong>{{ Auth::user()->level}}</strong>
            </div>
        </x-rodape>
        <!-- ✏️ Modal de Edição de Usuário -->
        <div x-show="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
            style="display: none;">
            <div @click.away="editModal = false"
                class="bg-white p-6 rounded-lg w-full max-w-xl max-h-[90vh] overflow-y-auto shadow-lg">
                @include('users.partials.form-edit')
            </div>
        </div>
    </div>

</x-app-layout>