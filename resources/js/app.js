try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.BASEURL = process.env.MIX_APP_URL;
window.axios = require('axios');
axios.defaults.baseURL = `${BASEURL}/api/`;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('vue-spa-token')}` ;
axios.interceptors.response.use(function (response){
        return response;
    }, function (error){
        if (error.response.status == 401){
            setTimeout(function (){
                // document.getElementById('logout-form').submit();
                // localStorage.removeItem('vue-spa-token')
                console.log(localStorage.getItem('vue-spa-token'))
            }, 1000);
        }
        return Promise.reject(error);
    }
);

let _csrf_tag = document.head.querySelector('meta[name=\"csrf-token\"]');
if (_csrf_tag) {
    var _csrf_token = _csrf_tag.content;
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = _csrf_token;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _csrf_token,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    location.reload();
}

window.Vue = require("vue");

if (process.env.NODE_ENV == "production") {
    Vue.config.devtools = false;
    Vue.config.productionTip = false
}

import { Form, AlertError, AlertErrors, HasError, AlertSuccess } from "vform";
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)

import swal from "sweetalert2";
window.swal = swal;
window.toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000
});

import NProgress from "nprogress";
import "nprogress/nprogress.css";
window.NProgress = NProgress;

window.Fire = new Vue();
window.Form = Form;

import Vue from 'vue'
// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

Vue.component("messages-list", require("./components/Messages.vue").default)
Vue.component("friends-list", require("./components/Friends.vue").default)
Vue.component("users-list", require("./components/Users.vue").default)

if (process.env.NODE_ENV == 'production') {
    Vue.config.devtools = false;
    Vue.config.productionTip = false
}
const app = new Vue({
    el: '#app',
});
