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
            colors: {
                // 60% Dominant Brand Blue family (Kabar Priangan Identity)
                'kp-blue': {
                    50: '#F0F7FD',
                    100: '#DDEEFA',
                    200: '#C2E0F6',
                    300: '#97CCEF',
                    400: '#64B0E5',
                    500: '#1C92DB',
                    600: '#0A72AC', // Main Official Logo Blue
                    700: '#085C8D',
                    800: '#094E75',
                    900: '#0C4262',
                },
                // 30% Clean Newspaper Surface (No dark black)
                'kp-canvas': '#F4F8FB', // Light clean paper canvas
                'kp-surface': '#FFFFFF', // Crisp white paper cards & tables
                'kp-border': '#E2E8F0',  // Subtle sheet hairline divider
                'kp-text': '#1E293B',    // Deep slate editorial text (not pitch black)
                'kp-muted': '#64748B',   // Secondary editorial text
                
                // 10% Print Amber Accent (Calls to action, highlight)
                'kp-accent': {
                    DEFAULT: '#D97706',
                    hover: '#B45309',
                    light: '#FEF3C7',
                    text: '#92400E',
                },
            },
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
