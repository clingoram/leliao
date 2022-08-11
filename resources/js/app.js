// main file to run vue 3.
import './bootstrap';

import '../sass/app.scss';

// vue
import { createApp } from 'vue';
import router from './router.js';
import App from './components/App.vue';
// import HeaderComponent from './components/HeaderComponent.vue';

// createApp(App).mount("#app");

// for header(login and register)
// const app2 = createApp(HeaderComponent);
// app2.use(router);
// app2.mount('#header');

// for whole files except header.
const app = createApp(App);
app.use(router);
app.mount('#app');