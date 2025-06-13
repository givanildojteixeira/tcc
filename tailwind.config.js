import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    
    darkMode: false,
    
    safelist: [
        // Para bordas coloridas
        {
            pattern: /border-(red|blue|green|gray|yellow|indigo|pink|purple|teal|orange|cyan)-(300|400|500|600|700)/,
        },
        // Para fundo (backgrounds)
        {
            pattern: /bg-(red|blue|green|gray|yellow|indigo|pink|purple|teal|orange|cyan)-(100|200|300|400|500|600|700)/,
        },
        // Para texto
        {
            pattern: /text-(red|blue|green|gray|yellow|indigo|pink|purple|teal|orange|cyan)-(500|600|700)/,
        },
        // Exemplo de hover de borda e bg se necessário
        {
            pattern: /hover:(bg|border)-(red|blue|green|gray|yellow|indigo|pink|purple|teal|orange|cyan)-(500|600)/,
        },
    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                shake: 'shake 0.4s ease-in-out',
            },
            keyframes: {
                shake: {
                '0%, 100%': { transform: 'translateX(0)' },
                '25%': { transform: 'translateX(-5px)' },
                '50%': { transform: 'translateX(5px)' },
                '75%': { transform: 'translateX(-5px)' },
                }
            }
        },
    },

    plugins: [forms],
};
