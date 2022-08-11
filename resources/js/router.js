import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

import App from './components/App.vue';
import LoginComponent from "./components/LoginComponent.vue";
import RegisterComponent from "./components/RegisterComponent.vue";
// import UserMenu from './components/UserMenu.vue';

// Route 設定
export const routes = [
  // home
  { path: '/', component: App },
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
    path: '/user/register',
    name: "register-page",
    component: RegisterComponent,
  },
  {
    path: '/user/login',
    name: "login-page",
    component: LoginComponent,
    // component: () => import('../js/components/LoginComponent.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: "/*",
    redirect: "/"
  }
];

const router = createRouter({
  mode: 'history',
  // history: createWebHistory(),
  history: createWebHistory(),
  routes,
});
export default router;