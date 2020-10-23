import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

Vue.config.productionTip = false

import 'bootstrap/dist/css/bootstrap.min.css'

// interceptor se duoc goi cho moi request, co the bien doi truoc khi gui request hoac bien doi response, tuong tu nhu middleware
axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 422) {
            // set error khi co status la 422
            store.commit("setErrors", error.response.data.errors);
        } else if (error.response.status === 401) {

            // set error khi co status la 401, chua xac thuc, set userData = null
            store.commit("auth/setUserData", null);
            localStorage.removeItem("authToken")
            // chuyen huong den router Login
            router.push({name: "Login"})
        } else {
            return Promise.reject(error)
        }
    }
)

// set header mac dinh cho moi request
axios.interceptors.request.use(function (config) {
    config.headers.common = {
        Authorization: `Bearer ${localStorage.getItem("authToken")}`,
        "Content-Type": "application/json",
        Accept: "application/json",
    };

    return config
})

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
