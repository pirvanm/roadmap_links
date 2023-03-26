<template>
    <label class="py-[10px] flex items-center justify-start font-[500] relative">
        <div class="w-[25px] h-[25px] mr-[7px] rounded-[5px] bg-white border border-[#ccc]"
             :class="{'bg-blue-500 bg-[url(https://uploads-ssl.webflow.com/612c64de4ad02d41c9a39b74/63f0105bf2b8ff9fa116696f_check-01.png)] bg-[length:14px_14px] bg-no-repeat bg-center border border-[#3898ec]': isChecked, 'checkbox-shadow-focus': checkboxFocus }" @click="toggleCheckbox"></div>
        <input type="checkbox" :value="value" :checked="checked" :name="name" class="opacity-0 absolute z-[-10]" @focus="checkboxFocus = true" @blur="checkboxFocus = false"/>
        <span class="font-[500] cursor-pointer text-sm flex-1 capitalize whitespace-nowrap" @click="toggleCheckbox">{{ label }}</span>
    </label>
</template>

<script lang="ts" setup>
import {ref, computed, watch, reactive} from "vue";

const checkboxFocus = ref(false);

const props = defineProps({
    checked: { type: [Array, Boolean] },
    value: { type: [Boolean, Object] },
    label: { type: String },
    name: {
        type: String,
        required: false
    },
});


const emit = defineEmits(["update:checked"]);
const checked = ref(props.checked);

const toggleCheckbox = () => {
    emit("update:checked");
};

const isChecked = computed(() => {
    return props.checked;
});


</script>

<style scoped>
.checkbox-shadow-focus {
    box-shadow: 0px 0px 3px 1px #3898ec;
}
</style>


