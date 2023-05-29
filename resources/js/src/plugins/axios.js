import axios from "axios";

axios.defaults.baseURL = '/api'
axios.defaults.withCredentials = true

axios.interceptors.request.use(function (config) {
    if(!config.url.includes('login') && !config.url.includes('register')){
      config.headers.Authorization = 'Bearer ' +localStorage.getItem('token');
    }
    return config;
  }, function (error) {
    // Do something with request error
    return Promise.reject(error);
});


export default axios