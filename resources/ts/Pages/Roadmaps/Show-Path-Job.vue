<script lang="ts" setup>
import VueTree from "@/Components/VueTree.vue";
import { Head, Link } from '@inertiajs/vue3';
import { ClipLoader } from "vue3-spinner";

import { PropType, ref, reactive } from "vue";
import { IRoadmap } from "@/ts/Types/IRoadmap";

import Icon from "@/Components/Icon.vue";


const props = defineProps({
    roadMap: Object as PropType<IRoadmap>,
});

const data = {
    id: props?.roadMap?.id,
    name: props?.roadMap?.name,
    description: props?.roadMap?.description,
    hasChildren: !!props.roadMap?.main_node.nodes.length,
    children: [],
};

// function loadRoadMap(parentNode, data) {
//     parentNode.nodes.forEach((node, nodeIndex) => {
//         const child = {
//             id: node.id,
//             name: node.name,
//             links: node.links,
//             description: node.description,
//             hasChildren: node?.nodes?.length,
//             children: [],
//         };
//         data.children.push(child);

//         if (node?.nodes?.length) {
//             loadRoadMap(node, child);
//         }
//     });
// }
//

const names = ["Functions", "Variables"];
function loadRoadMap(parentNode, data, names) {
    parentNode.nodes.forEach((node, nodeIndex) => {
        if (names.includes(node.name)) {
            const child = {
                id: node.id,
                name: node.name,
                links: node.links,
                description: node.description,
                hasChildren: node?.nodes?.length,
                children: [],
            };
            data.children.push(child);

            if (node?.nodes?.length) {
                loadRoadMap(node, child, names);
            }
        }
    });
}

// 

const treeConfig = { nodeWidth: 230, nodeHeight: 40, levelHeight: 200 };

loadRoadMap(props.roadMap.main_node, data, names);

const showNodeInfo = ref<boolean>(false);
const nodeInfoLoading = ref(false);
let nodeData = reactive({});

const nodeClicked = (node) => {
    nodeData = node.data;
    showNodeInfo.value = !showNodeInfo.value;
    nodeInfoLoading.value = true;

    console.log(nodeData);

    setTimeout(() => {
        nodeInfoLoading.value = false;
    }, 500)
};

</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-[999999]">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register</Link>
            </template>

        </div>

        <div class="container" v-if="data.hasChildren">
            <vue-tree :dataset="data" :config="treeConfig" @node-clicked="nodeClicked">
                <template v-slot:node="{ node, collapsed }">
                    <div class="rich-media-node" :style="{ border: collapsed ? '2px solid grey' : '' }">
                        <span style="font-weight: bold">
                            {{ node.name }}
                        </span>
                    </div>
                </template>
            </vue-tree>
        </div>

        <div v-show="showNodeInfo" class="absolute inset-0 min-h-screen z-[999999]">
            <div class="absolute inset-0 min-h-screen w-full bg-black opacity-20" @click="showNodeInfo = !showNodeInfo">
            </div>
            <div class="absolute min-w-[600px] max-w-[600px] min-h-screen right-0 bg-white p-4 pt-8">
                <div v-if="nodeInfoLoading" class="mt-[100px]">
                    <ClipLoader :loading="nodeInfoLoading" color="#22c55e" size="50px" />
                </div>
                <div v-else>
                    <div class="mb-4">
                        <button class="bg-green-500 text-white p-1 px-2 rounded flex gap-1.5 items-center text-sm">
                            <Icon name="check" class="w-[13px] h-[13px] fill-white text-white" />
                            <span>Mark As Done</span>
                        </button>
                    </div>
                    <button class="absolute right-[10px] top-[10px]" @click="showNodeInfo = !showNodeInfo">
                        <Icon name="close" class="w-[20px] h-[20px]" />
                    </button>
                    <h1 class="text-4xl font-bold font-roboto text-slate-700 mb-2">{{ nodeData.name }}</h1>
                    <p class="text-slate-600 text-sm mb-2">{{ nodeData.description }}</p>
                    <h2 class="text-lg text-slate-600 mb-1 border-b pb-1">Resources</h2>
                    <div class="flex flex-col gap-1 text-sky-500">
                        <template v-if="nodeData?.links?.length">
                            <a :href="link.link" target="_blank" class="hover:underline"
                                v-for="(link, linkIndex) in nodeData.links" :key="`link-${linkIndex}`">{{ link.title }}</a>
                        </template>
                        <template v-else>
                            <p class="text-slate-500">There are no links at this moment.</p>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.container {
    min-width: 100%;
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
