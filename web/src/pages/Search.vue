<script setup lang="ts">
import SearchForm from "../components/SearchForm.vue";
import SearchResults from "../components/SearchResults.vue";
</script>

<template>
  <div class="container">
    <SearchForm class="form-area" />
    <SearchResults class="results-area" />
  </div>
</template>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  gap: 1.875rem;
}

@media (min-width: 768px) {
  .container {
    flex-direction: row;
    align-items: start;
  }

  .form-area {
    box-sizing: border-box;
    width: 280px;
  }

  .results-area {
    height: 584px;
  }
}

@media (min-width: 1024px) {
  .form-area {
    width: 410px;
  }
}

.results-area {
  flex: 1;
  display: flex;
  flex-flow: column;
  overflow: hidden;
}
</style>
