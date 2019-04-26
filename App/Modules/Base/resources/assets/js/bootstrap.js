/**
 * Global packages
 */
import * as Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import Vuelidate from 'vuelidate';

/**
 * Common collejo Vue mixins
 */
import {Routes} from './_routes';
import {Permissions} from './_permissions';
import {Trans} from './_trans';
import {Notification} from './_notificationHelper';
import {FormHelpers} from './_formHelper';
import {TableHelper} from './_tableHelper';
import {PaginationHelper} from './_paginationHelper';
import {DateTimeHelpers} from './_dateTimeHelpers';

/**
 * Register global third party packages
 */
window._ = require('lodash');
window.Vue = require('vue');
window.moment = require('moment');

/**
 * Register third party Vue packages
 */
Vue.use(BootstrapVue);
Vue.use(Vuelidate);

/**
 * Register collejo Vue components
 */
Vue.component('notification', require('./components/Notification'));

/**
 * Get CSRF token for ajax requests
 */
const token = document.head.querySelector('meta[name="token"]');

if (!token) {

    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Setup Axios for ajax requests
 */
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
window.axios.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded';
window.axios.interceptors.response.use(response => {

	if(response.data.data && response.data.data.redir){

        window.location = response.data.data.redir;
	}

    return response;
}, error => {

    return Promise.reject(error);
});

/**
 * Setup Collejo global object
 */
window.C = {
    mixins : {
        Routes: Routes,
        Permissions: Permissions,
        Trans: Trans,
        FormHelpers: FormHelpers,
        TableHelper: TableHelper,
        PaginationHelper: PaginationHelper,
        DateTimeHelpers: DateTimeHelpers,
    },
    routes: [],
    langs: {},
    menus: [],
    sorting: null,
    notification: new Vue({
        mixins: [Notification],
        el: '#notification',
        props: {
            notifications: {
                default: () => [],
                type: Array
            }
        }
    }),
};

/**
 * Import collejo form components
 */
Vue.component('c-form-input', require('./components/form/Input'));

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });