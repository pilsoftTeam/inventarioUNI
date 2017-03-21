/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import vueClip from 'vue-clip'

Vue.use(vueClip);

Vue.component('user', require('./components/user/index.vue'));
Vue.component('super', require('./components/super/index.vue'));
Vue.component('admin', require('./components/admin/index.vue'));

const app = new Vue({
    el: '#app'
});
