<script setup lang="ts">
import { watch, ref, computed } from "vue";
import Button from "./Button.vue";
import Card from "./Card.vue";
import Table from "./Table.vue";
import { useRoute, useRouter } from "vue-router";
import { index as searchFilms, Film } from "../services/Film";
import { index as searchPeople, Character } from "../services/People";

const isLoading = ref(false);
const searchBy = ref<"films" | "people">("people");
const results = ref<(Film | Character)[]>([]);

const router = useRouter();
const route = useRoute();

watch(
  () => route.query,
  async (newQuery) => {
    try {
      searchBy.value = newQuery.by === "movies" ? "films" : "people";
      const searchTerm = newQuery.search as string;
      if (searchTerm) {
        isLoading.value = true;
        const method = searchBy.value === "people" ? searchPeople : searchFilms;
        results.value = await method(newQuery.search as string);
        isLoading.value = false;
      } else {
        isLoading.value = false;
        results.value = [];
      }
    } catch {
      results.value = [];
    } finally {
      isLoading.value = false;
    }
  },
  {
    immediate: true,
  }
);

const columns = computed(() => [
  searchBy.value === "people" ? "name" : "title",
  "action",
]);

const onDetailsClick = (id: number) => {
  router.push({
    name: searchBy.value === "people" ? "Character" : "Film",
    params: { id },
  });
};
</script>

<template>
  <Card>
    <h1>Results</h1>
    <hr />

    <div class="results">
      <Table :rows="results" :columns="columns" :loading="isLoading">
        There are zero matches.<br />
        Use the form to search for People or Movies.

        <template #col-action="{ row }: { row: Film | Character }">
          <Button @click="onDetailsClick(row.id)"> See details </Button>
        </template>
      </Table>
    </div>
  </Card>
</template>

<style scoped>
h1 {
  margin-bottom: 0.625rem;
}

.results {
  display: flex;
  flex: 1;
  overflow: auto;
  overflow: overlay;
}
</style>
