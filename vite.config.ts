import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

import { ConfigEnv, defineConfig } from "vite";
import tsconfigPaths from 'vite-tsconfig-paths'

import path from "path";

const pathResources = path.resolve(__dirname, "resources");

export default defineConfig(({command}: ConfigEnv) => {
    return {
        resolve: {
            alias: [
                {find: '@', replacement: path.resolve(__dirname, 'resources/ts/')},
                {find: '~/views', replacement: path.resolve(__dirname, 'resources/ts')},
                {find: '~/shared', replacement: path.resolve(__dirname, 'resources/shared')},
            ],
        },
        base: command === 'build' ? '/dist/' : '',
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
            tsconfigPaths()
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
