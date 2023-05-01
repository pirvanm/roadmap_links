<template>
    <label class="py-[10px] flex items-center justify-start font-[500] relative">
        <div class="w-[25px] h-[25px] mr-[7px] rounded-[5px] border border-[#ccc]"
             :class="{' bg-[url(/checkbox.png)] bg-[length:14px_14px] bg-orange-400 bg-no-repeat bg-center border border-[#3898ec]': isChecked, 'checkbox-shadow-focus': checkboxFocus }" @click="toggleCheckbox"></div>
        <input type="checkbox" :value="value" :checked="checked" :name="name" class="opacity-0 absolute z-[-10]" @focus="checkboxFocus = true" @blur="checkboxFocus = false"/>
        <span class="font-[500] cursor-pointer text-sm flex-1 capitalize whitespace-nowrap" @click="toggleCheckbox">{{ label }}</span>
    </label>
</template>

<script lang="ts" setup>
import {ref, computed} from "vue";

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


