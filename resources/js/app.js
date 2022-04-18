require('./bootstrap');

import { createApp } from 'vue';

// import AppComponent from './vue-src/components/App';
import AppComponent from './vue-src/components/App';

let app = createApp({});

app.component('app-component', AppComponent);
app.mount("#app");