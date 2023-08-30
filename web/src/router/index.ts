import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    name: "Film",
    path: "/film/:id",
    component: () => import("../pages/Film.vue"),
  },
  {
    name: "Character",
    path: "/character/:id",
    component: () => import("../pages/Character.vue"),
  },
  {
    name: "Search",
    path: "/:pathMatch(.*)*",
    component: () => import("../pages/Search.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
