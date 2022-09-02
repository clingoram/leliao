import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

// import App from '../components/App.vue';

import UserMenu from '../components/users/UserMenu.vue';
import LoginComponent from "../components/users/LoginComponent.vue";
import RegisterComponent from "../components/users/RegisterComponent.vue";
// import LogoutComponent from "../components/users/LogoutComponent.vue";

// import Posts from "../components/Post/PostsComponent.vue";
import PostComponent from "../components/Post/PostComponent.vue";
import AddArticleComponent from "../components/Post/AddArticleComponent.vue";

// import ForumComponent from "../components/Forum/ForumComponent.vue";

import MainComponent from "../components/Content/MainContentComponent.vue";
import NotFound from "../components/404.vue";

// Route 設定
export const routes = [
  {
    // 首頁看板類別和文章區塊
    path: "/:main(.*)*",
    name: "main",
    component: MainComponent,
    // add 
    // children: [
    //   {
    //     path: '/f/:category/p/:id',
    //     name: "post",
    //     component: PostComponent,
    //   }
    // ]
  },
  {
    // 註冊
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
    // 登入
    path: '/login',
    name: "login-page",
    component: LoginComponent,
    // component: () => import("../components/users/LoginComponent.vue"),
    meta: {
      middleware: "guest",
      title: `Login`
    }
  },
  {
    // 新增文章
    path: '/add_post',
    name: "add",
    component: AddArticleComponent,
    meta: {
      auth: true
    }
  },
  {
    // 單一類別的某篇文章，例如工作版內的文章C
    path: '/f/:categoryId/post/:id',
    name: "post",
    component: PostComponent,
    props: true
    // meta: {
    //   // public routes
    //   auth: undefined
    // }
  },
  {
    path: "/:domain(.*)*",
    name: "NotFound",
    // component: NotFound
    component: () => import("../components/404.vue"),
  },


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
export default router;