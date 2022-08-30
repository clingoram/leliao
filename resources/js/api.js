import axios from 'axios';

export const API_URL = 'http://leliao/api/lel/';

const $api = axios.create({
  withCredentials: true,
  baseURL: API_URL,
  headers: { 'Content-Type': 'application/json' },
})

$api.interceptors.request.use((config) => {
  config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`
  return config;
},
  error => {
    return Promise.reject(error)
  }
)
export default $api;