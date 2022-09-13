// main file to run vue 3.
// import bootstrap from bootstrap.js
import './bootstrap';

import '../sass/app.scss';

// vue
import { createApp } from 'vue';
import router from './router/router.js';
import App from './components/app.vue';

// font-awesome
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss';
import '@fortawesome/fontawesome-free/css/all.css';

const app = createApp(App);
app.use(router);
app.mount('#app');