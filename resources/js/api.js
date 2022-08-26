import axios from 'axios';

export const API_URL = 'http://leliao/api/lel/';

const $api = axios.create({
  withCredentials: true,
  baseURL: API_URL,
  headers: { 'Content-Type': 'application/json' },
  timeout: 20000
})

$api.interceptors.request.use((config) => {
  config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`
  return config;
})


export default $api;