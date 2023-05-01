<script lang="ts" setup>
import { PropType } from 'vue';
import { router, useForm } from '@inertiajs/vue3';

import PrimaryButton from '@/Components/PrimaryButton.vue';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import FancyCheckbox from '@/Components/FancyCheckbox.vue'
import Select from '@/Components/Select.vue';

import { IRoadmap } from '@/ts/Types/IRoadmap';
import { ITag } from '@/ts/Types/ITag';


const props = defineProps({
    roadmap: {
        type: Object as PropType<IRoadmap>,
        default: null,
    },
    tags: {
        type: [] as PropType<ITag[]>,
        default: [],
    }
});

const form= useForm({
    id: props?.roadmap?.id,
    name: props?.roadmap?.name,
    description: props?.roadmap?.description,
    tag: props?.roadmap?.tag,
    status: props?.roadmap?.status ?? false,
})

const submit = () => {
    let url = props.roadmap ? route('roadmaps.update', {roadmap: props.roadmap.id}) : router('roadmaps.store');
    let method = props.roadmap ? 'patch' : 'post';

    form[method](url, {
        onSuccess: () => {
            form.reset();
        },
    });
};

const updateStatus = () => {
    form.status = !form.status;
};

const updateTag = (tag: ITag) => {
    form.tag = tag;
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
            <div class="flex flex-col">
                <Select v-model:selected="form.tag" label="Tag">
                    <option :value="null">Select a tag</option>
                    <option :value="tag" v-for="(tag, tagIndex) in tags" :key="'tag-'+String(tagIndex)" @update:selected="updateTag">
                        {{ tag.tag }}
                    </option>
                </Select>
            </div>
            <div class="flex flex-col gap-2">
                <InputLabel value="Description"/>
                <TextInput v-model="form.description"/>
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