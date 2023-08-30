<template>
  <div class="card">
    <slot />
  </div>
</template>

<style scoped>
.card {
  padding: 1.875rem;
  border-radius: 0.25rem;
  box-shadow: 0 1px 2px 0 var(--color-gray-dark);
  border: solid 1px var(--color-gainsboro);
  background-color: var(--color-fill-primary);
}
</style>
