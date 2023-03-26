<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import FancyCheckbox from '@/Components/FancyCheckbox.vue'
import { useForm } from '@inertiajs/vue3';

import { ITag} from '@/Types/ITag';

const form = useForm<ITag>({
    id: null,
    tag: null,
    color: '#f6b73c',
    status: false,
})

const submit = () => {
    form.post(route('tags.store'), {
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
                Create New Tag
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-5">
                    <div class="w-5/12">
                        <form @submit.prevent="submit">
                            <div class="space-y-2 mb-2">
                                <div class="flex flex-col gap-2">
                                    <InputLabel value="Tag"/>
                                    <TextInput v-model="form.tag"/>
                                    <InputError :message="form.errors.tag"/>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <InputLabel value="Color"/>
                                    <TextInput type="color" v-model="form.color"/>
                                    <InputError :message="form.errors.color"/>
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
