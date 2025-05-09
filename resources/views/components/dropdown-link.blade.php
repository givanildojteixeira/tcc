@props(['disabled' => false, 'title' => null, 'align' => 'left'])

@php
    $baseClasses = 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 w-full';
    $extraClasses = $disabled ? 'pointer-events-none' : '';
    $alignmentClasses = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
    $classes = $baseClasses . ' ' . $extraClasses . ' ' . $alignmentClasses;
    $finalTitle = $disabled ? ($title ?? 'Acesso restrito') : ($title ?? null);
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
        <div class="absolute left-0 top-full mt-1 bg-red-500 text-white text-xs px-2 py-1 rounded shadow z-50 whitespace-nowrap">
            ⚠️ Acesso restrito!
        </div>
    </template>
</div>
