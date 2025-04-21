@props(['active' => false, 'disabled' => false, 'title' => null])

@php
    $baseClasses = 'inline-flex items-center px-1 pt-1 border-b-2 transition duration-150 ease-in-out';
    $activeClasses = 'border-indigo-400 dark:border-indigo-600 text-base font-bold leading-5 text-blue dark:text-gray-100 focus:outline-none focus:border-indigo-700';
    $inactiveClasses = 'border-transparent text-sm font-medium leading-5 text-black dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700';
    $extraClasses = $disabled ? 'pointer-events-none' : '';

    $classes = $baseClasses . ' ' . ($active ? $activeClasses : $inactiveClasses) . ' ' . $extraClasses;

    $finalTitle = $disabled 
        ? ($title ?? 'Acesso restrito') 
        : ($title ?? null);
@endphp

<div x-data="{
        showDenied: false,
        trigger() {
            this.showDenied = true;
            setTimeout(() => this.showDenied = false, 3000);
        }
    }" class="relative">

    <a 
        {{ $attributes->merge([
            'class' => $classes, 
            'title' => $finalTitle,
            '@click.prevent' => $disabled ? 'trigger()' : null
        ]) }}
    >
        {{ $slot }}
    </a>

    <template x-if="showDenied">
        <div class="absolute top-full mt-1 left-0 bg-red-500 text-white text-xs px-2 py-1 rounded shadow z-50">
            ⚠️ Acesso restrito!
        </div>
    </template>
</div>
