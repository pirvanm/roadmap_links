<script lang="ts" setup>
    import DialogModal from '@/Components/DialogModal.vue';
    import { router, useForm } from '@inertiajs/vue3';
    import { PropType, onMounted, reactive, watch } from 'vue';

    import Multiselect from '@vueform/multiselect'

    import FancyCheckbox from '@/Components/FancyCheckbox.vue';
    import Select from '@/Components/Select.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import Textarea from '@/Components/Textarea.vue';

    import ILink from '@/ts/Types/ILink';
    import { ITag } from '@/ts/Types/ITag';

    interface IOption {
        value: number;
        label: string;
    };

    const emit = defineEmits(['closeDialog']);

    const props = defineProps({
        link: {
            type: Object as PropType<ILink>,
            default: null,
        },
        tags: {
            type: Array as PropType<Array<ITag>>,
            default: [],
        },
        showDialog: {
            type: Boolean,
            default: false,
        },
        roadMapRoute: {
            type: String,
            default: null,
        }
    });

    const tags : IOption[] = props.tags.map((tag: ITag) => {
        return {
                value: tag.id,
                label: tag.tag,
            };
    });


    const submit = () => {
        let url = props.link ? route('links.update', {link: props.link.id})
                                :  route('links.store');
        let method = props.link ? 'patch' : 'post';

        if (props.roadMapRoute && !props.link) {
            url = props.roadMapRoute;
        }

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

    const updateDifficulty = (difficulty: string) => {
        form.difficulty = difficulty;
    };

    const updateType = (type : string) => {
        form.type = type;
    };

    const setForm = () => {
        return useForm({
            id: props.link?.id,
            title: props.link?.title,
            link: props.link?.link,
            short_description: props.link?.short_description,
            difficulty: props.link?.difficulty ?? null,
            type: props.link?.type ?? null,
            status: props.link?.status ?? false,
            tags: props.link?.tags?.length ? props.link?.tags.map((tag: ITag) => {
                return tag.id;
            }) : [] as IOption[] | Number[],
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
            <span v-if="!link">Create New Link</span>
            <span v-else>Edit Link</span>
        </template>
        <template #content>
            <form @submit.prevent="submit">
                <div class="space-y-2 mb-2">
                    <div class="flex flex-col gap-2">
                        <InputLabel value="Title"/>
                        <TextInput v-model="form.title"/>
                        <InputError :message="form.errors.title"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <InputLabel value="Link"/>
                        <TextInput v-model="form.link"/>
                        <InputError :message="form.errors.link"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <InputLabel value="Short Description"/>
                        <Textarea v-model="form.short_description"/>
                        <InputError :message="form.errors.short_description"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <InputLabel value="Type"/>
                        <Select :selected="form.type"  @update:selected="updateType">
                            <option :value="null">Select a type</option>
                            <option value="article">Article</option>
                            <option value="video">Video</option>
                            <option value="post">Post</option>
                            <option value="tool">Tool</option>
                        </Select>
                        <InputError :message="form.errors.type"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <InputLabel value="Difficulty"/>
                        <Select :selected="form.difficulty" @update:selected="updateDifficulty">
                            <option :value="null">Select a difficulty</option>
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="advanced">Advanced</option>
                        </Select>
                        <InputError :message="form.errors.difficulty"/>
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
                        <InputError v-if="form?.errors?.tags?.length" :message="form.errors.tags"/>
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

<style src="@vueform/multiselect/themes/default.css"></style>