<template>
  <nav>
    <h1>
      <router-link to="/">SWStarter</router-link>
    </h1>
  </nav>
</template>

<style scoped>
nav {
  height: 3.125rem;
  width: 100%;
  display: grid;
  place-items: center;
  box-shadow: 0 2px 0 0 var(--color-gainsboro);
  background-color: #fff;
}

a {
  color: var(--color-brand);
  font-weight: 700;
}

a:hover {
  color: var(--color-brand-dark);
}
</style>
