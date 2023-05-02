<script lang="ts" setup>
    import DialogModal from '@/Components/DialogModal.vue';
    import { useForm } from '@inertiajs/vue3';
    import { PropType, onMounted, reactive, watch } from 'vue';

    import FancyCheckbox from '@/Components/FancyCheckbox.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';

    import { ITag } from '@/ts/Types/ITag';

    const emit = defineEmits(['closeDialog']);

    const props = defineProps({
        tag: {
            type: Object as PropType<ITag>,
            default: null,
        },
        showDialog: {
            type: Boolean,
            default: false,
        },
    });

    
    const submit = () => {
        let url = props.tag ? route('tags.update', {tag: props.tag.id}) : route('tags.store');
        let method = props.tag ? 'patch' : 'post';

        form[method](url, {
            onSuccess: () => {
                form.reset();
                closeDialog();
            },
        });
    };

    const updateStatus = () => {
        form.status = !form.status;
    };

    const setForm = () => {
        return useForm({
            id: props?.tag?.id,
            tag: props?.tag?.tag,
            color: props?.tag?.color ?? '#f6b73c',
            status: props?.tag?.status ? props.tag.status : false,
        });
    };

    const closeDialog = () => {
        emit('closeDialog');
    };

    watch (props, () => {
        form = setForm();
    });

    let form = setForm();
    
</script>

<template>
    <DialogModal :show="showDialog" @close="closeDialog">
        <template #title>
            <span v-if="!tag">Create New Tag</span>
            <span v-else>Edit Tag</span>
        </template>
        <template #content>
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
            </form>
        </template>
        <template #footer>
            <PrimaryButton type="submit" @click="submit">Save</PrimaryButton>
        </template>
    </DialogModal>
</template>
