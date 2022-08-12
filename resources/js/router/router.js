import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

import LoginComponent from "../components/users/LoginComponent.vue";
import RegisterComponent from "../components/users/RegisterComponent.vue";
// import UserMenu from '../components/UserMenu.vue';

// Route 設定
export const routes = [
  // {
  //   path: '/user/',
  //   component: UserMenu,
  //   children: [
  //     {
  //       path: 'register',
  //       component: RegisterComponent,
  //       name: "register-page"
  //     },
  //     {
  //       path: 'login',
  //       component: LoginComponent,
  //       name: "login-page",
  //       helper: LoginComponent
  //     },
  //   ],
  // },
  {
    path: '/register',
    name: "register-page",
    component: RegisterComponent,
  },
  {
    path: '/login',
    name: "login-page",
    component: LoginComponent,
    meta: { requiresAuth: true },
  },
  {
    path: "/*",
    redirect: "/"
  },
];

const router = createRouter({
  mode: 'history',
  // history: createWebHistory(),
  history: createWebHistory(),
  routes,
});
export default router;