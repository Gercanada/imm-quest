/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../css/vue_modal.css');

window.Vue = require('vue').default;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('documets-component', require('./components/DocumentsComponent.vue').default);

Vue.component('clitem-component', require('./components/CLItemComponent.vue').default);
Vue.component('show-case-component', require('./components/ShowCaseComponent.vue').default);
Vue.component('change_themme', require('./components/ChangeThemmeComponent.vue').default);
Vue.component('commboard-component', require('./components/CommboardComponent.vue').default);
Vue.component('sync-cp-component', require('./components/SyncCPImmcase.vue').default);
Vue.component('checklist-component', require('./components/Checklist/ChecklistComponent.vue').default);
Vue.component('iframesurvey-component', require('./components/IframeSurveyComponent.vue').default);
Vue.component('portal-menu', require('./components/PortalAdmin.vue').default);
// Vue.component('send-command-component',   require('./components/SendCommandComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    //el: '#app',
    el: '#main-wrapper',
    data: {
        menu: 0
    },
});