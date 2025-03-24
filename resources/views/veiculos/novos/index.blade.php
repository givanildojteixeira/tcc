<x-app-layout>
    <x-slot name="header" >
        <!-- Carrossel de Veículos -->
        <div class="swiper mySwiper " style="width: 50%; margin: 0;">
            <div class="swiper-wrapper">
                @foreach($imagens as $imagem)
                @php
                $familia = ucfirst(pathinfo(basename($imagem), PATHINFO_FILENAME));
                @endphp
                <div class="swiper-slide text-center">
                    <a href="{{ route('veiculos.novos.filtro', ['familia' => $familia]) }}">
                        <img src="{{ asset('images/familia/' . basename($imagem)) }}" alt="Imagem do Veículo" class="rounded-lg w-full object-cover">
                        <div class="text-sm font-semibold mt-2 text-center">{{ $familia }}</div>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Botões de navegação fora do carrossel -->
            <div class="swiper-button-prev" style="position: absolute; left: 10px;"></div>
            <div class="swiper-button-next" style="position: absolute; right: 10px;"></div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="p-6 text-gray-900">


                        <table class="table-auto w-full">
                            <thead class="bg-gray-100 text-left">
                                <tr>
                                    <th class="p2">Veículo</th>
                                    <th>modelo</th>
                                    <th>Comb</th>
                                    <th>Ano_Mod</th>
                                    <th>Chassi</th>
                                    <th>Cor</th>
                                    <th>Pts</th>
                                    <th>Opcional</th>
                                    <th>Tabela</th>
                                    <th>Bonus</th>
                                    <th>Custo</th>
                                    <th>Faturado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($veiculos as $veiculo)
                                <tr class="hover:bg-gray-100">
                                    <td class="p-2">{{ $veiculo->desc_veiculo }}</td>
                                    <td class="p-2">{{ $veiculo->modelo_fab }}</td>
                                    <td class="p-2">{{ $veiculo->combustivel}}</td>
                                    <td class="p-2">{{ $veiculo->Ano_Mod}}</td>
                                    <td class="p-2">{{ $veiculo->chassi }}</td>
                                    <td class="p-2">{{ $veiculo->cor }}</td>
                                    <td class="p-2">{{ $veiculo->portas}}</td>
                                    <td class="p-2">{{ $veiculo->cod_opcional}}</td>
                                    <td class="p-2">{{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}</td>
                                    <td class="p-2">{{ number_format($veiculo->vlr_bonus, 0, ',', '.') }}</td>
                                    <td class="p-2">{{ number_format($veiculo->vlr_nota, 0, ',', '.') }}</td>
                                    <td class="p-2">
                                        {{ \Carbon\Carbon::parse($veiculo->dta_faturamento)->diffInDays(now()) }} dias
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 4, // Nro de Veiculos exibidos por vez
                spaceBetween: 0, // Espaço entre imagens
                loop: true, // Carrossel infinito
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    </script>

</x-app-layout>