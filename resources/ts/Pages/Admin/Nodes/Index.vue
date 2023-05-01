<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SVGTreeGraph from '@/Icons/SVGTreeGraph.vue';
import { router } from '@inertiajs/vue3';
import { PropType } from 'vue';
import {Link} from '@inertiajs/vue3';

import IRoadmapNode from '@/Types/IRoadmapNode';

const props = defineProps({
    nodes: {
        type: [] as PropType<IRoadmapNode[]>,
        default: [],
    },
    parentNode: {} as PropType<IRoadmapNode>
})

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-700 leading-tight">
                RoadMaps Nodes - {{ parentNode.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex justify-end mb-4">
                    <PrimaryButton @click="router.visit(route('roadmaps.nodes.create', {node: parentNode.id}))">Create</PrimaryButton>
                </div>
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <table v-if="nodes.length" class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Name</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Links</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Created At</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                            <tr v-for="(nodeItem, nodeIndex) in nodes" :key="'roadmap-'+String(nodeIndex)" class="hover:bg-gray-50">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="font-medium text-gray-700">{{ nodeItem.id }}</div>
                                </th>
                                <td class="px-6 py-4 text-center">{{ nodeItem.name }}</td>
                                <td class="px-6 py-4 text-center">{{ nodeItem.links_count }}</td>
                                <td class="px-6 py-4 text-center">
                                    {{ nodeItem.created_at }}
                                </td>
                                <td class="px-6 py-4">
                                <div class="flex justify-end gap-4">
                                    <div class="cursor-pointer" @click="router.visit(route('roadmaps.nodes.index', {node: nodeItem.id}))">
                                        <SVGTreeGraph class="w-6 h-6 text-gray-300 fill-gray-500 hover:fill-sky-500"/>
                                    </div>
                                    <a href="#">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6"
                                            x-tooltip="tooltip"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                            />
                                        </svg>
                                    </a>
                                    <Link :href="route('roadmaps.nodes.edit', {node: parentNode.id, childNode: nodeItem.id})">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6"
                                            x-tooltip="tooltip"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                            />
                                        </svg>
                                    </Link>
                                </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="p-3">
                        <p>There are no nodes, please create one.</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
