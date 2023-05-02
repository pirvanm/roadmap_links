<script lang="ts" setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { INode } from '@/Types/INode';
import { PropType, ref, reactive } from 'vue';

import LinksTable from '@/Pages/Admin/Links/Table.vue';
import FormDialog from '@/Pages/Admin/Links/FormDialog.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import ConfirmationModal from '@/Components/ConfirmationModal.vue';

import Form from './Form.vue';
import { ITag } from "@/ts/Types/ITag";
import ILink from "@/ts/Types/ILink";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    parentNode: {
        type: Object as PropType<INode>,
    },
    childNode: {
        type: Object as PropType<INode>,
        default: null,
    },
    tags: {
        type: [] as PropType<ITag[]>,
        default: [],
    }
});

const showDialog = ref(false);
let link = reactive<ILink>({} as ILink);

const createLink = () => {
    link = {} as ILink;;
    showDialog.value = true;
};

const onLinkEdit = (linkToUpdate: ILink) => {
    link = linkToUpdate
    showDialog.value = true;
};

const closeDialog = () => {
    link =  {} as ILink;
    showDialog.value = false;
};

const showLinkConfirmationModal = ref(false);

const deleteLinkAction = (linkToDelete: ILink) => {
    showLinkConfirmationModal.value = true;
    link = linkToDelete;
};

const deleteLink = () => {
    router.delete(route('roadmaps.nodes.delete-link', {node: props?.childNode?.id, link: link?.id}), {
        onSuccess: () => {
            showLinkConfirmationModal.value = false;
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
                Add New Node
            </h2>
        </template>

        <div class="py-12 mb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-5">
                    <div class="w-5/12">
                        <Form :parent-node="parentNode" :child-node="childNode"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex justify-end mb-4">
                    <PrimaryButton @click="createLink">Create</PrimaryButton>
                </div>
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <LinksTable :links="childNode.links" :node-editing="true" @on-link-edit="onLinkEdit" @on-delete-link-action="deleteLinkAction"/>
                </div>
            </div>
        </div>
        
        <FormDialog 
            :show-dialog="showDialog" 
            :road-map-route="route('roadmaps.nodes.store-link', {node: childNode.id})" 
            :link="link" 
            :tags="tags" 
            @close-dialog="closeDialog"
        />

        <ConfirmationModal :show="showLinkConfirmationModal">
            <template #title>
                Confirm Deletion
            </template>
            <template #content>
                Are you sure you want to delete the link?
            </template>
            <template #footer>
                <div class="flex gap-2">
                    <PrimaryButton @click="showLinkConfirmationModal = !showLinkConfirmationModal">Cancel</PrimaryButton>
                    <PrimaryButton @click="deleteLink">Confirm</PrimaryButton>
                </div>
            </template>
        </ConfirmationModal>
    </AppLayout>
</template>
