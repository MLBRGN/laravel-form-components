// vite.config.mjs

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/main.js',
                'resources/js/html-editor.js',
                'resources/css/main.scss',
                'resources/js/preview.js',
                'resources/css/preview.scss',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'dist',
        rollupOptions: {
            output: {
                entryFileNames: (chunk) => {
                    if (chunk.facadeModuleId.includes('main.js')) {
                        return `js/mlbrgn-form-components.js`; // Custom filename for JS
                    }
                    if (chunk.facadeModuleId.includes('html-editor.js')) {
                        return `js/mlbrgn-html-editor.js`; // Custom filename for JS
                    }
                    if (chunk.facadeModuleId.includes('preview.js')) {
                        return `js/preview.js`; // Custom filename for JS
                    }
                    return 'assets/[name].[hash].js';
                },
                assetFileNames: (chunk) => {
                    if (chunk.name === 'main.css') {
                        return `css/mlbrgn-form-components.css`; // Custom filename for CSS
                    }
                    if (chunk.name === 'preview.css') {
                        return `css/preview.css`; // Custom filename for CSS
                    }
                    return 'assets/[name].[hash][extname]';
                },
            },
        },
    },
});
