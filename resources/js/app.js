
require('./bootstrap');

window.Vue = require('vue');

import swal from 'sweetalert2';
window.swal = swal;

Vue.component('protexa', require('./components/Protexa.vue').default);

const app = new Vue({
    el: '#app'
});