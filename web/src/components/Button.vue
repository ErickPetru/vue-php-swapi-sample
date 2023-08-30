<template>
  <button><slot /></button>
</template>

<style scoped>
button {
  box-sizing: border-box;
  min-height: 2.125rem;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 1.25rem;
  background-color: var(--color-brand);
  text-align: center;
  font-size: 0.875rem;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--color-text-inverse);
  cursor: pointer;
  transition: background-color var(--transition), box-shadow var(--transition);
}

button:not(:disabled):hover {
  background-color: var(--color-brand-dark);
}

button:not(:disabled):active {
  box-shadow: inset 0 1px 4px -1px var(--color-text-primary);
}

button:disabled {
  background-color: var(--color-text-tertiary);
  cursor: not-allowed;
}
</style>
