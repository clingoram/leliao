// import _ from 'lodash';
// window._ = _;

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
window.axios.defaults.headers.common['Authorization'] = `Bearer ${sessionStorage.getItem("token")}`;

window.axios.defaults.withCredentials = true;

// window.interceptors.request.use(function (config) {
//   const token = sessionStorage.setItem("token", response.data.accessToken);
//   // config.headers.Authorization = `Bearer ${sessionStorage.getItem("token")}`
//   config.headers.common['Authorization'] = `Bearer ${token}`

//   return config;
// }, function (error) {
//   return Promise.reject(error);
// })

// window.interceptors.response.use(undefined, function (error) {
//   switch (error.response.status) {
//     case 404:
//     case 419:
//     case 503:
//       window.location.reload();
//       break;
//     case 500:
//       alert("Something wrong");
//       break;
//     default:
//       return Promise.reject(error);
//   }
// });

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
