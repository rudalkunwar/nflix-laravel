import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            output: 'public/build', // Specify the output directory
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            external: ['video.js', '@videojs/http-streaming', 'videojs-hls-quality-selector']
        },
        manifest: true, // Ensure the manifest is generated
    },
});
