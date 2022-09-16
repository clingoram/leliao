// main file to run vue 3.
// import bootstrap from bootstrap.js
import './bootstrap';

import '../sass/app.scss';

// vue
import { createApp } from 'vue';
import router from './router/router.js';
import App from './components/app.vue';

/* font-awesome */

// import '@fortawesome/fontawesome-free/webfonts/regular.min.js';

// import '@fortawesome/fontawesome-free/scss/all.scss';
// import '@fortawesome/fontawesome-free/scss/regular.scss';
// import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
// import '@fortawesome/fontawesome-free/scss/brands.scss';
// import '@fortawesome/fontawesome-free/scss/solid.scss';
// import '@fortawesome/fontawesome-free/scss/v4-shims.scss';


import '@fortawesome/fontawesome-free/js/all.js';
import '@fortawesome/fontawesome-free/js/fontawesome.js';
import '@fortawesome/fontawesome-free/js/regular.js';
import '@fortawesome/fontawesome-free/js/solid.js';
// import '@fortawesome/fontawesome-free/webfonts/fa-regular-400.woff2';



// import '../font-awesome/css/all.min.css';
// import '../font-awesome/css/regular.min.css';


const app = createApp(App);
app.use(router);
app.mount('#app');