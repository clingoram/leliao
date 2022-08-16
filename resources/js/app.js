// main file to run vue 3.
import './bootstrap';

import '../sass/app.scss';

// vue
import { createApp } from 'vue';
import router from './router/router.js';
import App from './components/App.vue';

const app = createApp(App);
app.use(router);
app.mount('#app');