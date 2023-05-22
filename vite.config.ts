import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

import { ConfigEnv, defineConfig } from "vite";
import tsconfigPaths from 'vite-tsconfig-paths'

import svgLoader from 'vite-svg-loader'

import path from "path";

const pathResources = path.resolve(__dirname, "resources");

export default defineConfig(({command}: ConfigEnv) => {
    return {
        resolve: {
            alias: [
                {find: '@', replacement: path.resolve(__dirname, 'resources/ts/')},
                {find: '~/views', replacement: path.resolve(__dirname, 'resources/ts')},
                {find: '~/shared', replacement: path.resolve(__dirname, 'resources/shared')},
                {find: '~/assets', replacement: path.resolve(__dirname, 'resources/assets')},
            ],
        },
        base: command === 'build' ? '/build/' : '',
        build: {
            manifest: true,
            outDir: "public/build",
            rollupOptions: {
                input: {
                    app: "resources/ts/app.ts",
                },
            },
        },
        plugins: [
            laravel({
                input: "resources/ts/app.ts",
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            tsconfigPaths(),
            svgLoader()
        ],
        server: {
            hmr: {
                host: "localhost",
            },
        },
        optimizeDeps: {
            include: [
                "axios",
                "vue",
            ],
        },
    }
});
