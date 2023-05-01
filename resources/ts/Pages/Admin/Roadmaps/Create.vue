<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import Form from './Form.vue';

import { IRoadmap } from '@/Types/IRoadmap';
import { ITag } from '@/Types/ITag';

const props = defineProps({
    roadmap: {
        type: Object as IRoadmap,
        default: null,
    },
    tags: {
        type: [] as PropType<ITag[]>,
        default: [],
    }
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Roadmap
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                    <div class="w-5/12">
                        <Form :roadmap="roadmap" :tags="tags"/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
