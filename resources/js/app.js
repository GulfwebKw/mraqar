/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.Swal = require('sweetalert2');
window.events = new Vue();
window.swalError = function (err) {
    Swal.fire({
        title: 'Error',
        text: err,
        icon: 'warning',
    });
};
const instance = axios.create()

instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
// instance.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector(
//     'meta[name="csrf-token"]'
// ).content

window.axios = instance

window.swalSuccess = function (msg) {
    Swal.fire({
        icon: 'success',
        title: 'Done!',
        text: msg,
    });

};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('sign-up', require('./components/site/auth/SignUp.vue').default);
Vue.component('add-to-wishlist', require('./components/site/wishlist/AddToWishlist').default);
Vue.component('like', require('./components/site/likes/Like').default);
Vue.component('comment', require('./components/site/comments/comment').default);
Vue.component('booking', require('./components/site/advertising/Booking').default);
Vue.component('create', require('./components/site/advertising/Create').default);
Vue.component('edit', require('./components/site/advertising/Edit').default);
Vue.component('wishlist-index', require('./components/site/wishlist/WishlistIndex').default);
Vue.component('show-user', require('./components/site/user/ShowUser').default);
Vue.component('profile', require('./components/site/user/Profile').default);
Vue.component('advertises', require('./components/site/user/Advertises').default);
Vue.component('search-section', require('./components/site/SearchSection').default);
import VueToast from 'vue-toast-notification';
Vue.use(VueToast);
import uploader from 'vue-simple-uploader'
Vue.use(uploader)



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

});
