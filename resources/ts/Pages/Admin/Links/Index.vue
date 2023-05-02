<script lang="ts" setup>
import { PropType, reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3'

import Table from './Table.vue';
import FormDialog from './FormDialog.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


import ConfirmationModal from '@/Components/ConfirmationModal.vue';

import ILink from '@/ts/Types/ILink';
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
let link = reactive<ILink>({} as ILink);

const onLinkEdit = (linkToUpdate: ILink) => {
    link = linkToUpdate;
    showDialog.value = true;
};

const createLink = () => {
    link = {} as ILink;
    showDialog.value = true;    
};

const closeDialog = () => {
    showDialog.value = false;
};

const showConfirmationModal = ref(false);

const deleteLinkAction = (linkToDelete: ILink) => {
    showConfirmationModal.value = true;
    link = linkToDelete;
};

const deleteLink = () => {
    router.delete(route('links.destroy', {link: link?.id}), {
        onSuccess: () => {
            showConfirmationModal.value = false;
        },
        onError: () => {

        },
    })
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
                    <Table :links="links" @on-link-edit="onLinkEdit" @on-delete-link-action="deleteLinkAction"/>
                </div>
            </div>
        </div>
        <FormDialog 
            :show-dialog="showDialog" 
            :link="link" 
            :tags="tags" 
            @close-dialog="closeDialog"

            />
        <ConfirmationModal :show="showConfirmationModal">
            <template #title>
                Confirm Deletion
            </template>
            <template #content>
                Are you sure you want to delete the link?
            </template>
            <template #footer>
                <div class="flex gap-2">
                    <PrimaryButton @click="showConfirmationModal = !showConfirmationModal">Cancel</PrimaryButton>
                    <PrimaryButton @click="deleteLink">Confirm</PrimaryButton>
                </div>
            </template>
        </ConfirmationModal>
    </AppLayout>
</template>
