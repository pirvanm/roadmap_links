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
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Title</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Link</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Difficulty</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Type</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Status</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Created At</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center"></th>
            </tr>
        </thead>
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
    </table>
</template>