<script setup lang="ts">
import { computed } from "vue";

const props = defineProps<{
  modelValue: string;
}>();

const emit = defineEmits<{
  (e: "update:modelValue", value: string): void;
}>();

const value = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});
</script>

<template>
  <input v-model="value" />
</template>

<style scoped>
input {
  box-sizing: border-box;
  border: solid 1px var(--color-gainsboro);
  border-radius: 0.25rem;
  padding: 0.5rem;
  min-height: 2.5rem;
  padding: 0.6875rem 0.625rem;
  box-shadow: inset 0 1px 3px 0 var(--color-gray-dark);
  border: solid 1px var(--color-text-tertiary);
  background-color: var(--color-fill-primary);
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--color-text-primary);
  transition: border-color var(--transition);
  cursor: text;
}

input:hover {
  border-color: var(--color-gray-dark);
}

input::placeholder {
  color: var(--color-text-tertiary);
}
</style>
