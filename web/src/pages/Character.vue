<script setup lang="ts">
import { ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import Button from "../components/Button.vue";
import Card from "../components/Card.vue";
import MutedText from "../components/MutedText.vue";
import { Character, show } from "../services/People";

const isLoading = ref(true);
const entity = ref<Character | null>(null);

const router = useRouter();
const route = useRoute();

watch(
  () => route.params,
  async (newParams) => {
    try {
      isLoading.value = true;
      const id = newParams.id as string;
      if (id) entity.value = await show(id);
      else entity.value = null;
    } catch {
      entity.value = null;
    } finally {
      isLoading.value = false;
    }
  },
  {
    immediate: true,
  }
);

const onBackClick = () => {
  if (history.state?.back?.startsWith("/?")) router.back();
  else router.push("/");
};
</script>

<template>
  <div class="container">
    <Card>
      <MutedText v-if="isLoading">Loading...</MutedText>

      <div v-else-if="entity">
        <h1>{{ entity.name }}</h1>

        <div class="results">
          <div>
            <h2>Details</h2>
            <hr />

            <p>
              Birth Year:
              <span>{{ entity.birth_year }}</span>
            </p>

            <p>
              Gender:
              <span>{{ entity.gender }}</span>
            </p>

            <p>
              Eye Color:
              <span>{{ entity.eye_color }}</span>
            </p>

            <p>
              Hair Color:
              <span>{{ entity.hair_color }}</span>
            </p>

            <p>
              Height:
              <span>{{ entity.height }}</span>
            </p>

            <p>
              Mass:
              <span>{{ entity.mass }}</span>
            </p>
          </div>

          <div>
            <h2>Movies</h2>
            <hr />

            <nav>
              <template v-for="(film, index) of entity.films" :key="film.id">
                <span v-if="index > 0">, </span
                ><router-link :to="`/film/${film.id}`">{{
                  film.title
                }}</router-link>
              </template>
            </nav>
          </div>
        </div>
      </div>

      <MutedText v-else>
        No character found.<br />
        Please check the provided information and try again.
      </MutedText>

      <Button @click="onBackClick">Back to search</Button>
    </Card>
  </div>
</template>

<style scoped>
.results {
  display: flex;
  flex-direction: column;
  gap: 1.875rem;
  margin: 1.875rem 0;
}

.results > div {
  flex: 1;
}

.results p {
  margin: 0.25rem 0;
}

@media (min-width: 768px) {
  .results {
    flex-direction: row;
    align-items: start;
  }
}

@media (min-width: 1024px) {
  .results {
    gap: 6.25rem;
  }
}

hr {
  margin: 0.625rem 0;
}
</style>
