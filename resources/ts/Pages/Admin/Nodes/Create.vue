<script lang="ts" setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { INode } from '@/Types/INode';
import { PropType } from 'vue';

import Form from './Form.vue';

const props = defineProps({
    parentNode: Object as PropType<INode>,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add New Node
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-5">
                    <div class="w-5/12">
                        <Form :parent-node="parentNode"/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
