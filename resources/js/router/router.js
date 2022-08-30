import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

// import App from '../components/App.vue';

import UserMenu from '../components/users/UserMenu.vue';
import LoginComponent from "../components/users/LoginComponent.vue";
import RegisterComponent from "../components/users/RegisterComponent.vue";
// import LogoutComponent from "../components/users/LogoutComponent.vue";

// import ContentComponent from "../components/ContentComponent.vue";
import AddArticleComponent from "../components/AddArticleComponent.vue";
import ForumComponent from "../components/ForumComponent.vue";

import MainComponent from "../components/MainContentComponent.vue";
import NotFound from "../components/404.vue";

// Route 設定
export const routes = [

  // {
  //   path: '/home',
  //   name: 'home',
  //   component: App,
  //   // meta: {
  //   //   // public routes
  //   //   auth: undefined
  //   // }
  // },
  // {
  //   path: '/users/',
  //   component: UserMenu,
  //   children: [
  //     {
  //       path: 'register',
  //       name: "register-page",
  //       component: RegisterComponent,
  //     },
  //     {
  //       path: 'login',
  //       name: "login-page",
  //       component: LoginComponent,
  //     },
  //     {
  //       path: 'logout',
  //       name: "logout",
  //       component: LogoutComponent,
  //     },
  //   ],
  // },

  {
    // 看板類別和文章區塊
    path: "/:main(.*)*",
    name: "main",
    component: MainComponent,
  },
  {
    path: '/register',
    name: "register-page",
    component: RegisterComponent,
    // redirect: '/',

    // 動態載入(不須載入API)
    // component: () => import("../components/users/RegisterComponent.vue"),
    meta: {
      middleware: "guest",
      title: `Register`
    }
  },
  {
    path: '/login',
    name: "login-page",
    component: LoginComponent,
    // component: () => import("../components/users/LoginComponent.vue"),
    meta: {
      middleware: "guest",
      title: `Login`
    }
  },
  // {
  //   path: '/logout',
  //   name: "logout",
  //   component: LogoutComponent,
  //   // component: () => import("../components/users/LogoutComponent.vue"),
  //   meta: {
  //     auth: false
  //   }
  // },
  {
    // 新增文章
    path: '/add_post',
    name: "add",
    component: AddArticleComponent,
    // meta: { requiresAuth: true },
    meta: {
      auth: false
    }
  },
  {
    path: "/:domain(.*)*",
    name: "NotFound",
    // component: NotFound
    component: () => import("../components/404.vue"),
  },


  // {
  // 特定文章
  //   path: '/article/:id',
  //   name: "article",
  //   component: ContentComponent,
  //   meta: {
  //     // public routes
  //     auth: undefined
  //   }
  // },
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
  //   path: '/',
  //   name: 'home',
  //   component: {
  //     // default: App,
  //     viewLeft: ForumComponent,
  //     viewRight: ContentComponent
  //   },
  //   meta: {
  //     // public routes
  //     auth: undefined
  //   }
  // },

  // {
  //   // for user
  //   path: '/dashboard',
  //   name: 'dashboard',
  //   component: Dashboard,
  //    meta: {
  //      middleware: "auth"
  //    },
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
  // path: "/*",
  // redirect: '/',
  //   name: 'home',
  //   component: App,
  // },
];

const router = createRouter({
  mode: 'history',
  // history: createWebHashHistory(),
  history: createWebHistory(),
  routes,
});

// add
router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  if (to.meta.middleware == "guest") {
    if (store.state.auth.authenticated) {
      next({ name: "dashboard" });
    }
    next();
  } else {
    if (store.state.auth.authenticated) {
      next();
    } else {
      next({ name: "login" });
    }
  }
})
export default router;