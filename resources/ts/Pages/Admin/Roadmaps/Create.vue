<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FormSection from '@/Components/FormSection.vue';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import FancyCheckbox from '@/Components/FancyCheckbox.vue'
import Select from '@/Components/Select.vue';
import { useForm } from '@inertiajs/vue3';

import { IRoadmap } from '@/Types/IRoadmap';
import { ITag } from '@/Types/ITag';

const props = defineProps({
    tags: {
        type: [] as PropType<ITag[]>,
        default: [],
    }
})

const form = useForm<IRoadmap>({
    id: null,
    name: null,
    tag: null,
    status: false,
})

const submit = () => {
    form.post(route('roadmaps.store'), {
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
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
