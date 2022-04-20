/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../css/vue_modal.css');

window.Vue = require('vue').default;


Vue.component('change_themme', require('./components/ChangeThemmeComponent.vue').default);
Vue.component('main-component', require('./components/MainComponent.vue').default);


const app = new Vue({
    //el: '#app',
    el: '#main-wrapper',
    data: {
        menu: 0
    },
});