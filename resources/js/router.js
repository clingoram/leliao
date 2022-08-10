
import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

import App from './components/App.vue';
import LoginComponent from "./components/LoginComponent.vue";
import RegisterComponent from "./components/RegisterComponent.vue";
import UserComponent from "./components/UserComponent.vue";

// Route 設定
export const routes = [
  // home
  { path: '/', component: App },
  // {
  //   path: '/user',
  //   component: UserComponent,
  //   children: [
  //     {
  //       // UserProfile will be rendered inside User's <router-view>
  //       // when /user/:id/profile is matched
  //       path: '/register',
  //       component: RegisterComponent,
  //       name: "register-page"
  //     },
  //     {
  //       // UserPosts will be rendered inside User's <router-view>
  //       // when /user/:id/posts is matched
  //       path: '/login',
  //       component: LoginComponent,
  //       name: "login-page",
  //     },
  //   ],
  // },
  {
    path: '/register',
    component: RegisterComponent,
    name: "register-page"
  },
  {
    path: '/login',
    component: LoginComponent,
    name: "login-page",
    meta: { requiresAuth: true },
  },
  { path: "/*", redirect: "/" }
];
const router = createRouter({
  mode: 'history',
  // url有hash tag
  // history: createWebHashHistory(),
  // url沒有hash tag
  history: createWebHistory(),
  routes,
});
export default router;