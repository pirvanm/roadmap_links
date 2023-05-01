<script lang="ts" setup>
import "@ssthouse/vue3-tree-chart/dist/vue3-tree-chart.css";
import { Head, Link } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";

import {PropType, ref, reactive} from "vue";
import {IRoadmap} from "@/ts/Types/IRoadmap";

import PrimaryButton from "@/Components/PrimaryButton.vue";


const props = defineProps({
    roadmaps: [] as PropType<IRoadmap[]>,
});

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

       <div class="max-w-7xl mx-auto sm:pt-32 px-2">
        <div class="border-b border-slate-300 pb-4 mb-8">
            <h1 class="text-4xl sm:text-5xl font-bold text-slate-900">Roadmaps</h1>
        </div>
            <div v-if="roadmaps.length" class="grid grid-cols-3 gap-8">
                <div class="shadow bg-white border-slate-100 rounded px-3 py-4" v-for="(roadmap, index) in roadmaps" :key="`roadmap-${index}`">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-3xl text-slate-800">{{  roadmap.name }}</h2>
                        <span class="text-slate-500">{{ roadmap.tag.tag }}</span>
                    </div>
                    <div class="min-h-[40px] max-h-[40px] mb-4">
                        <p class="text-sm text-slate-600">{{ roadmap.description }}</p>
                    </div>
                    <PrimaryButton @click="router.visit(route('roadmaps.show', {roadmap: roadmap.id}))">View</PrimaryButton>
                </div>
            </div>
            <div v-else>
                <p>There are no road maps at this moment.</p>
            </div>
       </div>

    </div>
</template>
