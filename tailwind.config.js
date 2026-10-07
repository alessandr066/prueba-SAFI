import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            }, colors: {
                ues: {
                    primary: '#8c1515',    // Rojo institucional
                    secondary: '#c41230',  // Rojo más brillante
                    light: '#f5f5f5',      // Fondo claro
                    dark: '#222222',       // Texto oscuro
                },
            },
        },
    },

    plugins: [forms],
};
