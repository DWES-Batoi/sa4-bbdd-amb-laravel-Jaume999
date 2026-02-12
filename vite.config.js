import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Permite conexiones externas al contenedor
        port: 5173,
        hmr: {
            host: 'localhost', // El navegador buscará los cambios en localhost
        },
        watch: {
            usePolling: true, // Obligatorio para que detecte cambios en Windows/Docker
        },
    },
});