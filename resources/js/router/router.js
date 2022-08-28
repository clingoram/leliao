import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

// import App from '../components/App.vue';

// import UserMenu from '../components/UserMenu.vue';
import LoginComponent from "../components/users/LoginComponent.vue";
import RegisterComponent from "../components/users/RegisterComponent.vue";
import LogoutComponent from "../components/users/LogoutComponent.vue";

import ContentComponent from "../components/ContentComponent.vue";
import AddArticleComponent from "../components/AddArticleComponent.vue";
import ForumComponent from "../components/ForumComponent.vue";

// Route 設定
export const routes = [
  // {
  //   path: '/users/',
  //   component: UserMenu,
  //   children: [
  //     {
  //       path: '/users/register',
  //       name: "register-page",
  //       component: RegisterComponent,
  //     },
  //     {
  //       path: '/users/login',
  //       name: "login-page",
  //       component: LoginComponent,
  //     },
  //     {
  //       path: '/users//logout',
  //       name: "logout",
  //       component: LogoutComponent,
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
    meta: {
      auth: false
    }
  },
  {
    path: '/logout',
    name: "logout",
    component: LogoutComponent,
    meta: {
      auth: false
    }
  },
  // {
  //   // 特定類別
  //   path: '/f/:id',
  //   name: "forum",
  //   component: ContentComponent,
  //   meta: {
  //     // public routes
  //     auth: undefined
  //   }
  // },
  // {
  //   path: '/home',
  //   name: 'home',
  //   component: App,
  //   meta: {
  //     // public routes
  //     auth: undefined
  //   }
  // },

  // {
  //   path: '/',
  //   // name: 'home',
  //   component: {
  //     default: App,
  //     a: ForumComponent,
  //     b: ContentComponent
  //   },
  //   meta: {
  //     // public routes
  //     auth: undefined
  //   }
  // },
  {
    // 新增文章
    path: '/add_article',
    name: "add",
    component: AddArticleComponent,
    // meta: { requiresAuth: true },
    meta: {
      auth: false
    }
  },
  // {
  //   // for user
  //   path: '/dashboard',
  //   name: 'dashboard',
  //   component: Dashboard,
  //   meta: {
  //     // for connected users
  //     auth: true
  //   }
  // },
  // {
  //   // for admin
  //   path: '/admin',
  //   name: 'admin.dashboard',
  //   component: AdminDashboard,
  //   meta: {
  //     auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/403' }
  //   }
  // }
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