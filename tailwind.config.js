/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./pages/**/*.blade.php",
        "./pages/**/*.md",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./config/markdown.php",
    ],
    theme: {
        fontFamily: {
            'mono': ['Fira Code', 'monospace'],
            'cal': ['Cal Sans', 'Nunito', 'sans-serif'],
        },
        extend: {
            animation: {
                'bounce-short': 'bounce 1s ease-in-out 5',
            },
            colors: {
                'primary': {
                    default: '#61a146',
                    '50': '#f6faf3',
                    '100': '#e9f5e3',
                    '200': '#d3eac8',
                    '300': '#afd89d',
                    '400': '#82bd69',
                    '500': '#61a146',
                    '600': '#4c8435',
                    '700': '#3d692c',
                    '800': '#345427',
                    '900': '#2b4522',
                    '950': '#13250e',
                },
            }
        },
    },
    plugins: [],
}

