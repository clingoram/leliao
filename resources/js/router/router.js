import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';


import LoginComponent from "../components/User/LoginComponent.vue";
import RegisterComponent from "../components/User/RegisterComponent.vue";
import Management from "../components/Management/ManagementComponent.vue";

import AddArticleComponent from "../components/Post/AddArticleComponent.vue";
import MainComponent from "../components/Content/MainContentComponent.vue";
// import NotFound from "../components/Error.vue";

// Route 設定
export const routes = [
  {
    // 首頁看板類別和文章區塊
    path: "/:main(.*)*",
    name: "main",
    component: MainComponent,
  },
  {
    // 註冊
    path: '/register',
    name: "register-page",
    component: RegisterComponent,
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
    // 管理頁面
    path: '/management',
    name: "management",
    component: Management,
    meta: {
      auth: true
    }
  },
  // {
  //   // 單一類別的某篇文章，例如工作版內的文章C
  //   path: '/f/:categoryId/post/:id',
  //   name: "post",
  //   component: PostComponent,
  //   props: true
  //   // meta: {
  //   //   // public routes
  //   //   auth: undefined
  //   // }
  // },
  // {
  //   path: "/:domain(.*)*",
  //   name: "NotFound",
  //   // component: NotFound
  //   component: () => import("../components/Error.vue"),
  // },
];

const router = createRouter({
  mode: 'history',
  // history: createWebHashHistory(),
  history: createWebHistory(),
  routes,
});
export default router;