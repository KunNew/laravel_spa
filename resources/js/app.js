const { default: router } = require('./router');

require('./bootstrap');

window.Vue = require('vue').default;

import store from './store/index.js'
import Vuetify from './plugins/vuetify'
import i18n from './plugins/localize'

import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    store: store,
    router: router,
    i18n
});
