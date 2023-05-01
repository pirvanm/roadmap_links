<script lang="ts" setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';


import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Textarea from '@/Components/Textarea.vue';

import { router, useForm } from '@inertiajs/vue3';
import { PropType } from 'vue';

import { IRoadmapNode } from '@/Types/IRoadmapNode';
import FancyCheckbox from "@/Components/FancyCheckbox.vue";

const props = defineProps({
    parentNode: {
        type: Object as PropType<IRoadmapNode>,
    },
    childNode: {
        type: Object as PropType<IRoadmapNode>,
        default: null,
    }
});

const form = useForm<IRoadmapNode>({
    id: props.childNode?.id,
    name: props.childNode?.name,
    description: props.childNode?.description,
    parent: {id: props.parentNode.id},
    status: props.childNode?.status ?? false,
})

const submit = () => {
    let url = props.childNode ? route('roadmaps.nodes.update', {node: props.childNode.id})
                              :  route('roadmaps.nodes.store');

    let method = props.childNode ? 'patch' : 'post';

    form[method](url, {
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
    <form @submit.prevent="submit">
        <div class="space-y-2 mb-2">
            <div class="flex flex-col gap-2">
                <InputLabel value="Name"/>
                <TextInput v-model="form.name"/>
                <InputError :message="form.errors.name"/>
            </div>
            <div class="flex flex-col gap-2">
                <InputLabel value="Description"/>
                <Textarea v-model="form.description"/>
                <InputError :message="form.errors.description"/>
            </div>
            <div class="flex flex-col gap-2">
                <FancyCheckbox label="Active" :checked="form.status" @update:checked="updateStatus"/>
                <InputError :message="form.errors.status"/>
            </div>
        </div>
        <PrimaryButton type="submit">Save</PrimaryButton>
    </form>
</template>

