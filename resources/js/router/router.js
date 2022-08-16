import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

import App from '../components/App.vue';
import LoginComponent from "../components/users/LoginComponent.vue";
import RegisterComponent from "../components/users/RegisterComponent.vue";
import ContentComponent from "../components/ContentComponent.vue";
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
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: "login-page",
    component: LoginComponent,
    // meta: { requiresAuth: true },
    meta: {
      auth: false
    }
  },
  {
    // 特定類別
    path: '/f/:id',
    name: "forum",
    component: ContentComponent,
    meta: {
      // public routes
      auth: undefined
    }
  },
  {
    path: '/home',
    name: 'home',
    component: App,
    meta: {
      // public routes
      auth: undefined
    }
  },
  {
    // for user
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      // for connected users
      auth: true
    }
  },
  {
    // for admin
    // path: '/admin',
    // name: 'admin.dashboard',
    // component: AdminDashboard,
    // meta: {
    //   auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/403' }
    // }
  }
  // {
  //   path: "/*",
  //   redirect: "/"
  // },
];

const router = createRouter({
  mode: 'history',
  // history: createWebHashHistory(),
  history: createWebHistory(),
  routes,
});
export default router;