<template>
    <label v-if="label" class="mb-2 block">{{ label }}</label>
    <select v-model="proxySelected"
            :disabled="disabled"
            class="h-9 w-full rounded bg-gray-150 border border-gray-300 py-1.5 px-3 text-sm focus:ring focus:ring-blue-200 outline-0 focus:bg-white focus:border-blue-300">
        <slot></slot>
    </select>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    emits: ['update:selected'],

    props: {
        selected: {
            type: [Array, Boolean, Number, String, Object],
            default: false,
        },
        error : {
            type: Boolean,
            default: false,
        },
        disabled: Boolean,
        label: {
            type: String,
            required: false
        }
    },

    computed: {
        inputClasses() {
            return this.error ? 'block w-full mt-1 text-sm border-red-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input'
                : 'block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray';
        },
        proxySelected: {
            get() {
                return this.selected;
            },

            set(val) {
                this.$emit("update:selected", val);
            },
        },
    },
})
</script>
