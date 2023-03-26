<script lang="ts" setup>
import VueTree from "@ssthouse/vue3-tree-chart";
import "@ssthouse/vue3-tree-chart/dist/vue3-tree-chart.css";
import { Head, Link } from '@inertiajs/vue3';
import {PropType} from "vue";
import {IRoadmap} from "@/ts/Types/IRoadmap";

const props = defineProps({
    roadMap: Object as PropType<IRoadmap>,
});

const data = {
    name: props?.roadMap?.name,
    hasChildren: !!props.roadMap?.nodes.length,
    children: [],
};

props.roadMap?.nodes.forEach((node) => {
    data.children.push({
        name: node.name,
        hasChildren: node?.nodes?.length,
        children: [],
    });
});

const treeConfig = { nodeWidth: 230, nodeHeight: 40, levelHeight: 200 };

</script>

<template>
    <Head title="Welcome" />

    <div class="relative min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-[999999]">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>

        </div>

        <div class="container" v-if="data.hasChildren">
            <vue-tree :dataset="data" :config="treeConfig">
                <template v-slot:node="{ node, collapsed }">
                    <div
                        class="rich-media-node"
                        :style="{ border: collapsed ? '2px solid grey' : '' }"
                    >
                          <span style="font-weight: bold">
                            {{ node.name }}
                          </span>
                    </div>
                </template>
            </vue-tree>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.container {
    width: 100%;
    min-height: 100vh;
}

.tree-container {
    min-height: 100vh;
    display: flex;
    gap: 20px;
}

.rich-media-node {
    padding: 10px 20px;
    text-align: center;
    color: #333;
    background-color: #ffcd4e;
    border-radius: 4px;
}
</style>
