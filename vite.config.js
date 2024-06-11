import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel(['resources/css/app.css', 'resources/js/app.jsx']),
    ],
    resolve: {
        alias: {
            '@': '/resources/jsx',
        },
    },
    build: {
        outDir: 'public/build',
    },
    server: {
        host: '192.168.8.107', 
        https: false
    },
});
