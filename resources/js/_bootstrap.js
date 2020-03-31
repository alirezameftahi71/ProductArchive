window.$ = window.jQuery = require('jquery');
window.Popper = require('popper.js').default;
window.Vue = require('vue');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('jquery-serializejson');
require('bootstrap');
require('bootstrap-3-typeahead');

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0].toLowerCase(), files(key).default))
