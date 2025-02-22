import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.js',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                main: '#ffc107',
                yellow: '#ffb703',
                'dark-blue': '#003049',
                green: '#4caf50',
                'blue-green': '#2a9d8f',
                orange: '#fb8500',
                red: '#F44336',
                'dark-orange': '#FF5722',
                past: '#e5e5e5'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'lg': '18px',
                '2xl': '20px',
                '3xl': '24px',

            },
            screens: {
                'sm': '480px',
                'md': '768px',
                'lg': '1280px',
            },
        },
    },

    plugins: [forms],
};
