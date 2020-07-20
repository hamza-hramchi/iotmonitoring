

require('./bootstrap');

/* ---------------------------------------------------------------------------- */

import { Form, HasError, AlertError } from 'vform'
import VueRouter from 'vue-router'
import Swal from 'sweetalert2'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';

/* ---------------------------------------------------------------------------- */

window.Vue = require('vue');
window.Swal = Swal;
window.Form = Form;
Vue.use(VueToast);
Vue.use(VueRouter);

/* ---------------------------------------------------------------------------- */

// Global component
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/* ---------------------------------------------------------------------------- */

let routes = [
    { path: '/', component: require('./components/HomeComponent.vue').default, name : 'home'},
    { path: '/module/:id', component: require('./components/ModuleComponent.vue').default, params : true, name : 'details'},
    { path: '/addModule', component: require('./components/AddModuleComponent.vue').default, name : 'addModule'}

]

/* ---------------------------------------------------------------------------- */

//Toast for SweetAlert2
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    window.Toast = Toast;

/* ---------------------------------------------------------------------------- */

const router = new VueRouter({
    mode : 'history',
    routes // raccourci pour `routes: routes`
    })

/* ---------------------------------------------------------------------------- */

const app = new Vue({
    el: '#app',
    router
});
