<script lang="ts" setup>
import { PropType } from 'vue';
import { router, useForm } from '@inertiajs/vue3';

import Multiselect from '@vueform/multiselect'

import PrimaryButton from '@/Components/PrimaryButton.vue';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import FancyCheckbox from '@/Components/FancyCheckbox.vue'
import Select from '@/Components/Select.vue';

import { IRoadmap } from '@/ts/Types/IRoadmap';
import { ITag } from '@/ts/Types/ITag';

interface IOption {
    value: number;
    label: string;
};

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

const tags : IOption[] = props.tags.map((tag: ITag) => {
    return {
            value: tag.id,
            label: tag.tag,
        };
});

const form= useForm({
    id: props?.roadmap?.id,
    name: props?.roadmap?.name,
    description: props?.roadmap?.description,
    tags: props?.roadmap?.tags?.length ? props.roadmap.tags.map((tag: ITag) => {
        return tag.id;
    }) : [] as IOption | Number[],
    status: props?.roadmap?.status ?? false,
})

const submit = () => {
    let url = props.roadmap ? route('roadmaps.update', {roadmap: props.roadmap.id}) : route('roadmaps.store');
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
            <div class="flex flex-col gap-2">
                <InputLabel value="Tags"/>
                <Multiselect
                    v-model="form.tags"
                    mode="tags"
                    :close-on-select="false"
                    :searchable="true"
                    :options="tags"
                />
                <InputError :message="form.errors.tags"/>
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


<style src="@vueform/multiselect/themes/default.css"></style>