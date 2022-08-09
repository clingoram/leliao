import './bootstrap';

import { createApp } from 'vue';
import app from './components/app.vue';

createApp(app).mount("#app");

// const createMyApp = options => {
//   const app = createApp(options);

//   // 加上全域設定
//   // app.component('my-btn', MyBtn);
//   return app;
// }

// createMyApp(app).mount("#app");
// // createMyApp(Bar).mount('#bar')