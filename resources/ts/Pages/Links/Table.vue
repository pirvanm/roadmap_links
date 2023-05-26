<script lang="ts" setup>
import { PropType } from 'vue';
import { Link } from '@inertiajs/vue3';

import ILink from '@/ts/Types/ILink';

const emit = defineEmits(['onLinkEdit', 'onDeleteLinkAction']);

const props = defineProps({
    links: {
        type: [] as PropType<ILink[]>,
        default: [],
    },
});

const editLink = (link: ILink) => {
    emit('onLinkEdit', link);
};

const deleteLinkAction = (link: ILink) => {
    emit('onDeleteLinkAction', link);
};

</script>

<template>
    <div class="max-w-7xl mx-auto sm:pt-32 px-1">
        <div class="border-b border-slate-300 pb-4 mb-8">
            <h1 class="text-4xl sm:text-5xl font-bold text-slate-900">Links</h1>
        </div>
        <div class="grid grid-cols-3 gap-8">
            <div class="shadow bg-white border-slate-100 rounded px-3 py-4" v-for="(link, linkIndex) in links">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl text-slate-800">{{ link.title }}</h2>

                </div>
                <div class="min-h-[40px] max-h-[40px] mb-4">
                    <p class="text-sm text-slate-600">{{ link.link }}</p>
                </div>
                <!-- <PrimaryButton @click="router.visit(route('roadmaps.show', { roadmap: roadmap.id }))">View
                </PrimaryButton> -->
            </div>
        </div>

    </div>


    <!-- <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">

        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            <tr v-for="(link, linkIndex) in links" :key="'link-' + String(linkIndex)" class="hover:bg-gray-50">
                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="font-medium text-gray-700">{{ link.id }}</div>
                </th>
                <td class="px-6 py-4 text-center">{{ link.title }}</td>
                <td class="px-6 py-4 text-center">{{ link.link }}</td>
                <td class="px-6 py-4 text-center">{{ link.difficulty }}</td>
                <td class="px-6 py-4 text-center">{{ link.type }}</td>
                <td class="px-6 py-4 flex justify-center">
                    <span v-if="Number(link.status)"
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                        Active
                    </span>
                    <span v-else
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-red-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                        Inactive
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    {{ link.created_at }}
                </td>

            </tr>
        </tbody>
    </table> -->
</template>