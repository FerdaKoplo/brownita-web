/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    secondary: '#607274',
                    light: '#E4D2A3',
                    lightdark: '#CCB88C',
                    dark: '#6C4E31',
                    caramel: '#A25E00'
                }
            },
            fontFamily: {
                kameron: ['Kameron', 'serif'],
            },
        },
    },
    plugins: [
    ],
}

