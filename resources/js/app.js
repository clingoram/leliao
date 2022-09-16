// main file to run vue 3.
// import bootstrap from bootstrap.js
import './bootstrap';

import '../sass/app.scss';

// vue
import { createApp } from 'vue';
import router from './router/router.js';
import App from './components/app.vue';

/* font-awesome */
import '@fortawesome/fontawesome-free/js/fontawesome.js';
import '@fortawesome/fontawesome-free/js/all.js';
import '@fortawesome/fontawesome-free/js/regular.js';
import '@fortawesome/fontawesome-free/js/solid.js';


const app = createApp(App);
app.use(router);
app.mount('#app');