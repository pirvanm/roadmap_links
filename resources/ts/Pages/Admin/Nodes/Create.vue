<script lang="ts" setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { PropType } from 'vue';

import { IRoadmapNode } from '@/Types/IRoadmapNode';
import FancyCheckbox from "@/ts/Components/FancyCheckbox.vue";

const props = defineProps({
    node: Object as PropType<IRoadmapNode>,
})

const form = useForm<IRoadmapNode>({
    id: null,
    name: null,
    parent: {id: props.node.id},
    status: false,
})

const submit = () => {
    form.post(route('roadmaps.nodes.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
};

const updateStatus = () => {
    form.status = !form.status;
};

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
                        <form @submit.prevent="submit">
                            <div class="space-y-2 mb-2">
                                <div class="flex flex-col gap-2">
                                    <InputLabel value="Name"/>
                                    <TextInput v-model="form.name"/>
                                    <InputError :message="form.errors.name"/>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <FancyCheckbox label="Active" :checked="form.status" @update:checked="updateStatus"/>
                                    <InputError :message="form.errors.status"/>
                                </div>
                            </div>
                            <PrimaryButton type="submit">Save</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
