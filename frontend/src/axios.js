import axios from 'axios';
import router from './router';

// Add a request interceptor
axios.interceptors.request.use(function (config) {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}, function (error) {
    return Promise.reject(error);
});

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {
        originalRequest._retry = true;
        router.push('/auth/logout'); // Logout the user and redirect to the login page
        return;
    }
    return Promise.reject(error);
});

export default axios;
