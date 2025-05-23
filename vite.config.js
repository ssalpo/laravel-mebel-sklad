import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import {VitePWA} from 'vite-plugin-pwa';
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VitePWA({
            registerType: 'autoUpdate',
            manifest: {
                scope: "/",
                id: "/",
                start_url: '/',
                name: "Учет Мебель 777",
                display: "standalone",
                orientation: "portrait",
                icons: [
                    {
                        "src": "/icons/icon_72.png",
                        "sizes": "72x72",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/icon_96.png",
                        "sizes": "96x96",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/icon_128.png",
                        "sizes": "128x128",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/icon_144.png",
                        "sizes": "144x144",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/icon_152.png",
                        "sizes": "152x152",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/icon_192.png",
                        "sizes": "192x192",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/icon_384.png",
                        "sizes": "384x384",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/icon_512.png",
                        "sizes": "512x512",
                        "type": "image/png",
                        "purpose": "any"
                    },
                    {
                        "src": "/icons/maskable_72.png",
                        "sizes": "72x72",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        "src": "/icons/maskable_96.png",
                        "sizes": "96x96",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        "src": "/icons/maskable_128.png",
                        "sizes": "128x128",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        "src": "/icons/maskable_144.png",
                        "sizes": "144x144",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        "src": "/icons/maskable_152.png",
                        "sizes": "152x152",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        "src": "/icons/maskable_192.png",
                        "sizes": "192x192",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        "src": "/icons/maskable_384.png",
                        "sizes": "384x384",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        "src": "/icons/maskable_512.png",
                        "sizes": "512x512",
                        "type": "image/png",
                        "purpose": "maskable"
                    }
                ]
            }
        })
    ],
    resolve: {
        alias: {
            '@': '/resources/js'
        }
    }
});
