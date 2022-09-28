import loadash from 'lodash'
window._ = loadash

import * as Popper from '@popperjs/core'
window.Popper = Popper

// import bootstrap
import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// 把token加到header內
// let api_token = document.head.querySelector('meta[name="csrf_token"]');

// if (api_token) {
//   window.axios.defaults.headers.common['X-CSRF-TOKEN'] = `Bearer ${api_token.content}`;
// } else {
//   console.log('error');
// }

window.axios.defaults.headers.common['Authorization'] = `Bearer ${sessionStorage.getItem("identity")}`;
// window.axios.defaults.headers.common['Authorization'] = this.JSON.parse(sessionStorage.getItem("branch")) !== null ? `Bearer ${this.JSON.parse(sessionStorage.getItem("branch"))}` : null;
window.axios.defaults.headers.common["Accept"] = "application/json";
window.axios.defaults.withCredentials = true;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//   broadcaster: 'pusher',
//   key: import.meta.env.VITE_PUSHER_APP_KEY,
//   wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws - ${ import.meta.env.VITE_PUSHER_APP_CLUSTER }.pusher.com`,
//   wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//   wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//   forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//   enabledTransports: ['ws', 'wss'],
// });


// import Echo from 'laravel-echo';
// import socket from 'socket.io-client';

// window.io = socket;
// window.Echo = new Echo({
//   broadcaster: 'socket.io',
//   host: window.location.hostname + ':6001'
// });