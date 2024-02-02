import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/test-unit.css', 'resources/js/test-unit.js'],
            refresh: true,
        }),
    ],
});
