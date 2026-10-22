/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                darker: '#090d16',
                dark: '#0f172a',
                card: '#1e293b',
                accent: '#2563eb', // Solid Blue (no gradients)
            },
        },
    },
    plugins: [forms],
}
