<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Histórico de Atividades') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
                <h3 class="text-lg font-bold text-blue-600">Reunião 04/10/25 – Orientadores #6</h3>

                <!-- Alterar informações do Veículo -->
                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">1. Em <span class="text-blue-500">Alterar
                            informações do Veículo</span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Campo <strong>Local</strong> está fora de alinhamento.</li>
                        <li>Botão de instruções exibe informações incompletas.</li>
                        <li>Ao clicar em <em>Voltar</em>, deve retornar para a série de novos e reabrir o modal com os
                            detalhes do veículo.</li>
                    </ul>
                </div>

                <!-- Detalhes do Veículo Novo -->
                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">2. Em <span class="text-blue-500">Detalhes do
                            Veículo Novo</span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Alinhamento inferior das tabelas precisa ser ajustado.</li>
                        <li>Quando o site não estiver cadastrado, o botão deve aparecer esmaecido ou desabilitado.</li>
                        <li>Funcionalidade dos documentos não está ativa.</li>
                    </ul>
                </div>

                <!-- Grade de Novos -->
                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">3. Em <span class="text-blue-500">Grade de
                            Novos</span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Filtro de cor deve ter a opção <strong>Todas as cores</strong>; criar tabela de cores com
                            cores esmaecidas quando sem estoque.</li>
                        <li>Busca por chassi com <kbd>Enter</kbd> não está automatizando a pesquisa; exige clique no
                            botão.</li>
                    </ul>
                </div>

                <!-- Opcionais -->
                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">4. Em <span
                            class="text-blue-500">Opcionais</span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Cadastrar todas as opções disponíveis para veículos.</li>
                    </ul>
                </div>

                <!-- Cadastros -->
                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">5. Em <span
                            class="text-blue-500">Cadastros</span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Novos cadastros (vendedores e assistentes) não têm acesso ao sistema.</li>
                        <li>Vendedores e assistentes devem ter acesso à lista de veículos (sem custos e bônus).</li>
                        <li>Gerentes devem ter acesso ao <strong>Bônus</strong>.</li>
                        <li>Diretores devem ter acesso ao <strong>Custo</strong> dos veículos.</li>
                    </ul>
                </div>

                <h3 class="text-lg font-bold text-blue-600">Ajustes e Melhorias Recentes</h3>
                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">6. Em <span class="text-blue-500">Alterar
                            informações do Veículo #7
                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Botão para excluir o veículo</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">7. Em <span class="text-blue-500">
                            Inclusão de Rodapé como padrão #8
                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>painel | família | opcionais | veículos novos | veículos usados | meus dados | lista de
                            usuários</li>
                    </ul>
                </div>


                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">8. Em <span class="text-blue-500">
                            Acerto com lista de usuários #9
                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>A lista deve ter o mesmo padrão</li>
                        <li>A lista deve ativar e desativar usuários</li>
                        <li>A lista deve poder manipular as funções do usuário</strong>.</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">9. Em <span class="text-blue-500">
                            Alterar informações do Veículo #10
                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Botao inativar / ativar</li>
                        <li>Botão [black friday]</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">10. Em <span class="text-blue-500">
                            Criação de novos usuários #11

                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Foi detectada uma vulnerabilidade: um novo usuário pode entrar no sistema e ter acesso aos
                            dados, sem passar por nenhum tipo de validação, portanto, quando para o usuário novo crio
                            ele como level = 'user' e direcione para uma tela que não permite que ele entre no sistema,
                            mas registre-o, depois de validado, e informe isso que ele agora aguarda um moderador.</li>
                    </ul>
                </div>


                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">11. Em <span class="text-blue-500">
                            Acesso aos menus por autorização #12

                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Acertar os menus para aparecer desabilitados para usuários que não tenham acesso</li>
                        <li>Acesso: Vendedor: Novos / Usados ​​/ Propostas / Relatórios /Cadastros: Clientes / Usuário:
                            Meus Dados / Usuário: Sair</li>
                        <li>Acesso Assistente: Novos / Usados ​​/ Propostas / Relatórios /Cadastros: Todos/ Usuário:
                            Meus Dados / Usuário: Sair</li>
                        <li>Acesso: Gerente, Diretor Todos exceto Usuário:Lista de Usuários</li>
                        <li>Acesso: Administrador : Tudo Liberado</li>
                        <li>Crie apenas o nível de programação, sem rotinas de Configuração de Acesso em tempo real</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">12. Em <span class="text-blue-500">
                            Padronizar tela de Cadastro de Clientes #13
                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>A tela de Cadastro de Clientes deve ter o mesmo padrão de cadastro de família, acessorios
                        </li>
                    </ul>
                </div>


                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">13. Em <span class="text-blue-500">
                            Tabela de condições de pagamento #14

                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Criar tabela e model</li>
                        <li>Criar view, controle e rota</li>
                        <li>Colocar dentro do padrão</li>
                        <li>Testar</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">14. Em <span class="text-blue-500">
                            Propostas fase 1 - Criar uma base #15


                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Criar as tabelas: modelo e migração</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">15. Em <span class="text-blue-500">
                            Propostas fase 2 - Criar as telas #16
                        </span>:</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>criar view, controlar e rota - Padrão</li>
                    </ul>
                </div>

                <p class="text-sm text-gray-500 mt-4">Atualizado em: {{ now()->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
