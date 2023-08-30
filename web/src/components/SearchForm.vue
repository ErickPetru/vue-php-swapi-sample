<script setup lang="ts">
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import Button from "./Button.vue";
import Card from "./Card.vue";
import Input from "./Input.vue";

const searchBy = ref("people");
const searchTerm = ref("");

const searchTermHint = computed(() => {
  if (searchBy.value === "people") {
    return "e.g. Chewbacca, Yoda, Boba Fett";
  } else {
    return "e.g. The Empire Strikes Back";
  }
});

const searchDisabled = computed(() => {
  return !searchTerm.value.length;
});

const router = useRouter();
const route = useRoute();

watch(
  () => route.query,
  (newQuery) => {
    searchBy.value = newQuery.by === "movies" ? "movies" : "people";

    if (newQuery.search) {
      searchTerm.value = newQuery.search as string;
    } else {
      searchTerm.value = "";
    }
  },
  {
    immediate: true,
  }
);

const onSubmit = () => {
  const query = {
    by: searchBy.value === "movies" ? "movies" : undefined,
    search: searchTerm.value,
  };

  router.push({
    name: "Search",
    query: {
      ...route.query,
      ...query,
    },
  });
};
</script>

<template>
  <Card>
    <form @submit.prevent="onSubmit">
      <h3>What are you searching for?</h3>

      <div class="radio-group">
        <label>
          <input type="radio" value="people" v-model="searchBy" />
          People
        </label>

        <label>
          <input type="radio" value="movies" v-model="searchBy" />
          Movies
        </label>
      </div>

      <Input
        type="text"
        name="searchTerm"
        :placeholder="searchTermHint"
        v-model="searchTerm"
      />

      <Button type="submit" :disabled="searchDisabled">Search</Button>
    </form>
  </Card>
</template>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.radio-group {
  display: flex;
  gap: 1.875rem;
}

.radio-group label {
  font-size: 0.875rem;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.radio-group input {
  margin: 0;
  font-size: 1rem;
}
</style>
