<script setup lang="ts">
import MutedText from "./MutedText.vue";

const props = defineProps<{
  columns?: string[];
  rows?: any[];
  loading: boolean;
}>();
</script>

<template>
  <MutedText v-if="props.loading">
    <slot name="loading">Loading...</slot>
  </MutedText>
  <table v-else-if="props.rows?.length">
    <tbody>
      <tr v-for="row of props.rows" :key="row.id">
        <td v-for="col of props.columns" :key="col">
          <slot :row="row" :name="`col-${col}`">
            {{ row[col] }}
          </slot>
        </td>
      </tr>
    </tbody>
  </table>
  <MutedText v-else><slot /></MutedText>
</template>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  table-layout: fixed;
  align-self: start;
}

table td {
  padding: 1rem 0;
  border-bottom: 1px solid var(--color-text-tertiary);
  font-size: 1rem;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

table td:first-child {
  font-weight: 700;
}

table td:last-child {
  text-align: right;
}
</style>
