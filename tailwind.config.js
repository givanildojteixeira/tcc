import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // 👇 ADICIONE AQUI
    safelist: [
            'bg-blue-200', 'hover:bg-blue-300',
        'bg-blue-600', 'hover:bg-blue-700',
        'bg-green-600', 'hover:bg-green-700',
        'bg-red-600', 'hover:bg-red-700',
        'bg-yellow-500', 'hover:bg-yellow-600',
        'bg-gray-600', 'hover:bg-gray-700',
        'bg-purple-600', 'hover:bg-purple-700',
        'bg-orange-500', 'hover:bg-orange-600',
        'bg-pink-500', 'hover:bg-pink-600',
        'bg-indigo-600', 'hover:bg-indigo-700',
        'bg-cyan-500', 'hover:bg-cyan-600',
        'bg-teal-500', 'hover:bg-teal-600',
        'bg-lime-500', 'hover:bg-lime-600',
        'bg-sky-500', 'hover:bg-sky-600',
        'bg-fuchsia-500', 'hover:bg-fuchsia-600',
        'bg-rose-500', 'hover:bg-rose-600',
        'bg-emerald-500', 'hover:bg-emerald-600',
        'bg-slate-600', 'hover:bg-slate-700',
        'bg-stone-500', 'hover:bg-stone-600',
        'bg-zinc-600', 'hover:bg-zinc-700',
        'bg-neutral-500', 'hover:bg-neutral-600',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
