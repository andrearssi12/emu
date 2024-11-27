import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/datatables/datatables.css',
                'resources/js/template/index.js', 
                'resources/js/datatables/datatables.js',
                'resources/js/map/mapbox-gl.js',
                'resources/js/map/mapbox-gl-draw.js',
                'resources/js/map/map.js',
            ],
            refresh: true,
        }),
    ],
});
