<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Consulta de Veículos</title>

    <!-- Fontes e Estilos -->
    <script src="https://kit.fontawesome.com/5c48256430.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.css" rel="stylesheet">

    <!-- App CSS/JS -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-CKLfAw3a.css') }}">
    <script type="module" src="{{ asset('build/assets/app-42Rp8jfk.js') }}"></script>
    @vite(['resources/js/app.js']);

    <!-- Scripts de terceiros -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <script src="https://unpkg.com/imask"></script>
</head>

<body class="font-sans antialiased overflow-hidden">
    <div class="flex flex-col h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow shrink-0">
                <div>{{ $header }}</div>
            </header>
        @endif

        <main class="flex-1 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    <x-loading />

    @if (session('success') || session('error') || session('warning') || session('info'))
        @php
            $type = session('success') ? 'success' : (session('error') ? 'error' : (session('warning') ? 'warning' : 'info'));
            $messages = [
                'success' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fa-check-circle'],
                'error' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fa-times-circle'],
                'warning' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'fa-exclamation-triangle'],
                'info' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'fa-info-circle'],
            ];
        @endphp
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed top-6 right-6 {{ $messages[$type]['bg'] }} {{ $messages[$type]['text'] }} px-4 py-3 rounded-md shadow-lg z-50 transition">
            <div class="flex items-center gap-2">
                <i class="fas {{ $messages[$type]['icon'] }}"></i>
                <span>{{ session($type) }}</span>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
                link.addEventListener('click', () => {
                    const alpine = document.querySelector('[x-data]');
                    if (alpine && alpine.__x) alpine.__x.$data.loading = true;
                });
            });

            const masks = {
                placa: {
                    mask: [
                        { mask: 'AAA-0000' },
                        { mask: 'AAA-0A00' },
                        { mask: 'AAA-00A0' },
                        { mask: 'AAA-000A' },
                        { mask: 'AAA-A000' },
                        { mask: 'AAA-A0A0' },
                        { mask: 'AAA-0AA0' },
                        { mask: 'AAA-00AA' }
                    ],
                    prepare: str => str.toUpperCase(),
                    overwrite: true
                }
                cpf: { mask: '000.000.000-00' },
                cnpj: { mask: '00.000.000/0000-00' },
                telefone: { mask: '(00) 0000-0000' },
                celular: { mask: '(00) 00000-0000' },
                cep: { mask: '00000-000' },
                data: { mask: '00/00/0000' },
                moeda: {
                    mask: Number,
                    scale: 2,
                    thousandsSeparator: '.',
                    radix: ',',
                    mapToRadix: ['.']
                }
            };

            Object.keys(masks).forEach(tipo => {
                const el = document.getElementById(`mask-${tipo}`);
                if (el) IMask(el, masks[tipo]);
            });

            document.querySelectorAll('[data-mask]').forEach(el => {
                const tipo = el.dataset.mask;
                if (masks[tipo]) IMask(el, masks[tipo]);
            });

            document.querySelectorAll('input[id^="vlr_"]').forEach(el => {
                IMask(el, masks.moeda);
            });
        });

        document.addEventListener('keydown', function (event) {
            const tag = document.activeElement.tagName.toLowerCase();
            const isEditable = ['textarea', 'input', 'select'].includes(tag);

            if (event.key === 'Enter' && !isEditable) {
                const salvar = document.querySelector('[data-atalho="salvar"]');
                if (salvar) {
                    event.preventDefault();
                    salvar.click();
                }
            }

            if (event.key === 'Escape') {
                const voltar = document.querySelector('[data-atalho="voltar"]');
                if (voltar?.href) {
                    window.location.href = voltar.href;
                }
            }
        });

        function salvarConfiguracao(chave, valor) {
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/configuracoes/salvar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({ chave, valor })
            })
            .then(async res => {
                if (!res.ok) throw new Error(await res.text());
                return res.json();
            })
            .then(data => {
                if (data.success) window.mostrarToast?.('Configuração salva!');
            })
            .catch(err => {
                alert('Erro ao salvar configuração: ' + (err.message || 'Erro desconhecido'));
            });
        }
    </script>
</body>

</html>
