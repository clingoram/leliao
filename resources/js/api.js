import axios from 'axios';

// export const API_URL = 'http://leliao/api/lel/';


// const $api = axios.create({
//   withCredentials: true,
//   baseURL: API_URL,
//   headers: { 'Content-Type': 'application/json' },
// })

const $api = axios.create();


$api.interceptors.request.use(function (config) {
  // config.headers.Authorization = `Bearer ${sessionStorage.getItem("token")}`
  return config;
}, function (error) {
  return Promise.reject(error);
})

$api.interceptors.response.use(function (response) {
  return response;
}, function (error) {

  if (error.response) {
    switch (error.response.status) {
      case 404:
        console.log("頁面不存在")
        // go to 404 page
        break
      case 500:
        console.log("程式發生問題")
        // go to 500 page
        break
      default:
        console.log(error.message)
    }
  }

  if (!window.navigator.onLine) {
    alert("網路出了點問題，請重新連線後重整網頁");
    return;
  }

  return Promise.reject(error);
});

// export default function (method, url, data = null, config) {
//   method = method.toLowerCase();
//   switch (method) {
//     case "post":
//       return $api.post(url, data, config);
//     case "get":
//       return $api.get(url, { params: data });
//     case "delete":
//       return $api.delete(url, { params: data });
//     case "put":
//       return $api.put(url, data);
//     case "patch":
//       return $api.patch(url, data);
//     default:
//       console.log(`未知的 method: ${method}`);
//       return false;
//   }
// };

// export default $api;