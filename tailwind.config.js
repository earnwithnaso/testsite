import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#000000',
                secondary: '#3A3A3A',
                brand: '#00C853', // Vibrant Green
                surface: '#FFFFFF',
                'soft-grey': '#F4F4F4', // Lighter grey for better contrast with white
                'border-grey': '#E5E5E5',
            },
            borderRadius: {
                '4xl': '32px',
                '5xl': '40px',
                '6xl': '60px',
            },
            boxShadow: {
                'soft': '0px 2px 10px rgba(0, 0, 0, 0.1)',
                'medium': '0px 4px 20px rgba(0, 0, 0, 0.15)',
                'floating': '0px 8px 30px rgba(0, 0, 0, 0.2)',
                'glow': '0 0 20px rgba(0, 200, 83, 0.3)',
            },
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'float-delayed': 'float 6s ease-in-out 3s infinite',
                'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                'spin-slow': 'spin 12s linear infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },

    plugins: [forms],
};
