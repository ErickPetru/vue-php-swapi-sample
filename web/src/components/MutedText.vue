<template>
  <div class="muted">
    <slot />
  </div>
</template>

<style scoped>
.muted {
  padding: 1.875rem 0;
  color: var(--color-text-tertiary);
  text-align: center;
  flex: 1;
  display: grid;
  place-items: center;
  font-weight: 700;
}
</style>
