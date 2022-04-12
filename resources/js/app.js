require('./bootstrap');

import { createApp } from 'vue';

import AppComponent from './components/App.vue';

let app = createApp({});

app.component('app-component', AppComponent);
app.mount("#app");