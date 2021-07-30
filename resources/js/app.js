require('./bootstrap');


import Vue from 'vue';

import App from './vue/app';
import ElementUI from 'element-ui'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUserSecret, faTrash);
Vue.use(ElementUI);
Vue.component('font-awesome-icon', FontAwesomeIcon);
const app = new Vue({
    el: '#app',
    components: { App }
});