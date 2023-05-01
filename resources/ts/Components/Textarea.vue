<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    type: {
        type: String,
        default: 'text',
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        ref="input"
        :type="type"
        class="border border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 p-1 rounded"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
</template>
