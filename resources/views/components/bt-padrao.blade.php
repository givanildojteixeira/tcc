{{--

Botao padrao
exemplos:
<x-bt-padrao cor="gray" icone="fas fa-arrow-left" texto="Voltar" href="{{ route('veiculos.novos.index') }}" atalho="voltar" />
<x-bt-padrao cor="green" icone="fas fa-save" texto="Salvar Alterações" type="submit" atalho="salvar" />
<x-bt-padrao cor="indigo" icone="fas fa-users" texto="Cadastro Famílias" href="{{ route('familia.index') }}" />

Cor	        Classe Base (bg-)	Classe Hover (hover:bg-)	Ideal Para
Azul	    bg-blue-600	        hover:bg-blue-700	        Ação principal, salvar
Verde	    bg-green-600	    hover:bg-green-700	        Sucesso, confirmar
red	        bg-red-600	        hover:bg-red-700	        Erros, excluir
yellow	    bg-yellow-500	    hover:bg-yellow-600	        Avisos, atenção
orange	    bg-orange-500	    hover:bg-orange-600	        Destaques, alertas
Roxo	    bg-purple-600	    hover:bg-purple-700	        Ações secundárias
pink	    bg-pink-500	        hover:bg-pink-600	        Informações suaves
Ciano	    bg-cyan-600	        hover:bg-cyan-700	        Visual informativo
Teal	    bg-teal-600	        hover:bg-teal-700	        Alternativo, suave
Cinza	    bg-gray-500	        hover:bg-gray-600	        Neutro, desativado
Cinza Claro	bg-gray-300	        hover:bg-gray-400	        Botão secundário
Indigo	    bg-indigo-600	    hover:bg-indigo-700	        Cadastros, navegação
Lime	    bg-lime-500	        hover:bg-lime-600	        Suave, criativo
Fuchsia	    bg-fuchsia-500	    hover:bg-fuchsia-600	    Moderno, divertido
Rose	    bg-rose-500	        hover:bg-rose-600	        Destaque elegante
Slate	    bg-slate-600	    hover:bg-slate-700	        Estilo escuro moderno
Stone	    bg-stone-500	    hover:bg-stone-600	        Neutro elegante
Emerald	    bg-emerald-500	    hover:bg-emerald-600	    Sucesso elegante
Sky	        bg-sky-500	        hover:bg-sky-600	        Ações leves
Neutral	    bg-neutral-500	    hover:bg-neutral-600	    Neutro para tudo

--}}

@props([
    'href' => null,
    'type' => 'button',
    'color' => 'blue', // Cores: blue, green, red, yellow, gray, indigo, etc.
    'icon' => null,
    'label' => 'Botão',
    'title' => null,
    'target' => null, // <- incluído para links com target="_blank"
])

@php
    $classes = "min-w-[100px] relative flex items-center gap-2 px-6 py-2 rounded-md shadow-md transition font-medium text-white bg-{$color}-500 hover:bg-{$color}-600";
@endphp

<div x-data="{ showTooltip: false }" class="relative inline-block group">
    @if ($href)
        <a href="{{ $href }}" @if ($target) target="{{ $target }}" @endif
            @mouseenter="showTooltip = true" @mouseleave="showTooltip = false"
            {{ $attributes->merge(['class' => $classes]) }}>
            @if ($icon)
                <i class="fas fa-{{ $icon }}"></i>
            @endif
            {{ $label }}
        </a>
    @else
        <button type="{{ $type }}" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false"
            {{ $attributes->merge(['class' => $classes]) }}>
            @if ($icon)
                <i class="fas fa-{{ $icon }}"></i>
            @endif
            {{ $label }}
        </button>
    @endif

    @if ($title)
    <div x-show="showTooltip"
         x-transition.opacity.scale.duration.200ms
         x-cloak
         class="absolute -top-12 left-1/2 transform -translate-x-1/2 z-50">
        <!-- Balão do tooltip -->
        <div class="relative bg-gray-800 text-white text-xs rounded px-3 py-1 shadow-md whitespace-nowrap">
            {{ $title }}
            <!-- Seta -->
            <div class="absolute bottom-[-5px] left-1/2 transform -translate-x-1/2 w-3 h-3 bg-gray-800 rotate-45 z-[-1]"></div>
        </div>
    </div>
@endif


</div>
