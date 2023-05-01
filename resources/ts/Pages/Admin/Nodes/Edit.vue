<script lang="ts" setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { INode } from '@/Types/INode';
import { PropType, ref } from 'vue';

import LinksTable from '@/Pages/Admin/Links/Table.vue';
import FormDialog from '@/Pages/Admin/Links/FormDialog.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import Form from './Form.vue';
import { ITag } from "@/ts/Types/ITag";
import ILink from "@/ts/Types/ILink";

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
const link = ref<ILink | undefined>({} as ILink);

const createLink = () => {
    link.value = undefined;
    showDialog.value = true;
};

const onLinkEdit = (linkToUpdate: ILink) => {
    link.value = linkToUpdate;
    showDialog.value = true;
};

const closeDialog = () => {
    link.value = undefined;
    showDialog.value = false;
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
                    <LinksTable :links="childNode.links" :node-editing="true" @on-link-edit="onLinkEdit"/>
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
    </AppLayout>
</template>
