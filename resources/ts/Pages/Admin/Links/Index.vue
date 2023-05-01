<script lang="ts" setup>
import { PropType, reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3'

import Table from './Table.vue';
import FormDialog from './FormDialog.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import ILink from '@/ts/Types/ILink';
import Link from '@/shared/interfaces/link';
import { ITag } from '@/ts/Types/ITag';

const props = defineProps({
    links: {
        type: [] as PropType<ILink[]>,
        default: [],
    },
    tags: {
        type: [] as PropType<ITag[]>,
        default: [],
    }
});

const showDialog = ref(false);
const link = ref<ILink | undefined>({} as ILink);

const onLinkEdit = (linkToUpdate: ILink) => {
    link.value = linkToUpdate;
    showDialog.value = true;
};

const createLink = () => {
    link.value = undefined;
    showDialog.value = true;    
};

const closeDialog = () => {
    showDialog.value = false;
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tags
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex justify-end mb-4">
                    <PrimaryButton @click="createLink">Create</PrimaryButton>
                </div>
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <Table :links="links" @on-link-edit="onLinkEdit"/>
                </div>
            </div>
        </div>
        <FormDialog :show-dialog="showDialog" :link="link" :tags="tags" @close-dialog="closeDialog"/>
    </AppLayout>
</template>
