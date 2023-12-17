import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/common.css',
                'resources/css/layout.css',
                'resources/css/project/project.css',
                'resources/css/project/todo.css',
                'resources/css/lib/jquery-ui.css',
                'resources/js/app.js',
                'resources/js/tailwind.js',
                'resources/js/lib/jquery-ui.js',
                'resources/js/lib/jquery-3.7.1.js',
                'resources/js/layout.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    },
});
