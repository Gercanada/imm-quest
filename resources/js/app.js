/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueLang from '@eli5/vue-lang-js'
import translations from './vue-translations.js';

require('./bootstrap');
require('../css/vue_modal.css');

require('lang.js');

window.Vue = require('vue').default;

// get the data source
Vue.component('change_themme', require('./components/ChangeThemmeComponent.vue').default);
Vue.component('content-component', require('./components/Content.vue').default);
Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('lang-component', require('./components/LangComponent.vue').default);
Vue.component('password-input', require('./components/custom/PasswordInput.vue').default);


/* Vue.use(VueLang, {
    messages: translations, // Provide locale file
    // locale: 'en', // Set locale
    fallback: 'en' // Set fallbasck lacale
}); */

const app = new Vue({
    el: '#main-wrapper',
    data: {
        menu: 0
    },
});