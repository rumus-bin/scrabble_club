import './bootstrap';
import 'tailwindcss/tailwind.css'
import '../css/app.css';
// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
})

import {createApp, h} from 'vue';
import App from './Components/App.vue';
import router from './router';


const app = createApp(App);
app.use(router);
app.use(vuetify);
app.mount('#scrabble_club');


