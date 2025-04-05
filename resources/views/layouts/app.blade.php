<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>Consulta de Veiculos</title>

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/5c48256430.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Outros estilos -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" /> --}}
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Scripts do Laravel -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper.js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script> --}}
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Scripts do Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <!-- bara de busca por valor usado -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">

    <!-- bara de busca por valor usado -->
    <link href="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Modal temporario para msgs -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


</head>


{{-- Mensgens e alertas na tela --}}
@if (session('success') || session('error') || session('warning') || session('info'))
    @php
        $type = session('success')
            ? 'success'
            : (session('error')
                ? 'error'
                : (session('warning')
                    ? 'warning'
                    : 'info'));

        $messages = [
            'success' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fa-check-circle'],
            'error' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fa-times-circle'],
            'warning' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'fa-exclamation-triangle'],
            'info' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'fa-info-circle'],
        ];
    @endphp

    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
        class="fixed top-6 right-6 {{ $messages[$type]['bg'] }} {{ $messages[$type]['text'] }} px-4 py-3 rounded-md shadow-lg z-50 transition"
        style="display: none;">
        <div class="flex items-center gap-2">
            <i class="fas {{ $messages[$type]['icon'] }}"></i>
            <span>{{ session($type) }}</span>
        </div>
    </div>
@endif




<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="mx-auto sm:px-4 lg:px-6"> {{-- retirei: max-w-7xl para ocupar a tela toda --}}
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>


    {{-- Aqui vou colocar todos os Script que quero que fiquem disponiveis para as views --}}
    <script>
        function salvarConfiguracao(chave, valor) {
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/configuracoes/salvar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    chave: chave,
                    valor: valor
                })
            })
            .then(async res => {
                if (!res.ok) {
                    const erroHtml = await res.text();
                    throw new Error(erroHtml);
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    window.mostrarToast?.('Configuração salva!');
                }
            })
            .catch(err => {
                console.error('❌ Erro ao salvar configuração:', err.message || err);
                alert('Erro ao salvar configuração: ' + (err.message || 'Erro desconhecido'));
            });
        }
    </script>



</body>




</html>
