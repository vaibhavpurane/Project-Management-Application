import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        // vue({
        //     template: {
        //         transformAssetUrls: {
        //             base: null,
        //             includeAbsolute: false,
        //         },
        //     },
        // }),
    ],
    // resolve: {
    //     alias: {
    //         vue: 'vue/dist/vue.esm-bundler.js',
    //     },
    // },
    optimizeDeps: {
        include: ['jquery', 'jquery-ui'],
    },
    build: {
        rollupOptions: {
            external: ['jquery', 'jquery-ui'],
            output: {
                globals: {
                    jquery: 'jQuery', // Ensure this matches the global variable name used by jQuery plugins
                    'jquery-ui': 'jQueryUI', // Adjust if necessary based on how jQuery UI registers itself globally
                },
            },
        },
    },
});
