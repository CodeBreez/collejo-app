window._ = require('lodash');
window.Vue = require('vue');

import {VueForm, Event} from 'vue-form-2'
import { Routes } from './routes';
import { Trans } from './trans';

Vue.use(VueForm);

window.C = {
	mixins : {
		Routes: Routes,
		Trans: Trans,
	},
	langs:{aa:{}, ab:{}, ae:{}, af:{}, ak:{}, am:{}, an:{}, ar:{}, as:{}, av:{}, ay:{}, az:{}, ba:{}, be:{}, bg:{}, bh:{}, bi:{}, bm:{}, bn:{}, bo:{}, br:{}, bs:{}, ca:{}, ce:{}, ch:{}, co:{}, cr:{}, cs:{}, cu:{}, cv:{}, cy:{}, da:{}, de:{}, dv:{}, dz:{}, ee:{}, el:{}, en:{}, eo:{}, es:{}, et:{}, eu:{}, fa:{}, ff:{}, fi:{}, fj:{}, fo:{}, fr:{}, fy:{}, ga:{}, gd:{}, gl:{}, gn:{}, gu:{}, gv:{}, ha:{}, he:{}, hi:{}, ho:{}, hr:{}, ht:{}, hu:{}, hy:{}, hz:{}, ia:{}, id:{}, ie:{}, ig:{}, ii:{}, ik:{}, io:{}, is:{}, it:{}, iu:{}, ja:{}, jv:{}, ka:{}, kg:{}, ki:{}, kj:{}, kk:{}, kl:{}, km:{}, kn:{}, ko:{}, kr:{}, ks:{}, ku:{}, kv:{}, kw:{}, ky:{}, la:{}, lb:{}, lg:{}, li:{}, ln:{}, lo:{}, lt:{}, lu:{}, lv:{}, mg:{}, mh:{}, mi:{}, mk:{}, ml:{}, mn:{}, mr:{}, ms:{}, mt:{}, my:{}, na:{}, nb:{}, nd:{}, ne:{}, ng:{}, nl:{}, nn:{}, no:{}, nr:{}, nv:{}, ny:{}, oc:{}, oj:{}, om:{}, or:{}, os:{}, pa:{}, pi:{}, pl:{}, ps:{}, pt:{}, qu:{}, rm:{}, rn:{}, ro:{}, ru:{}, rw:{}, sa:{}, sc:{}, sd:{}, se:{}, sg:{}, si:{}, sk:{}, sl:{}, sm:{}, sn:{}, so:{}, sq:{}, sr:{}, ss:{}, st:{}, su:{}, sv:{}, sw:{}, ta:{}, te:{}, tg:{}, th:{}, ti:{}, tk:{}, tl:{}, tn:{}, to:{}, tr:{}, ts:{}, tt:{}, tw:{}, ty:{}, ug:{}, uk:{}, ur:{}, uz:{}, ve:{}, vi:{}, vo:{}, wa:{}, wo:{}, xh:{}, yi:{}, yo:{}, za:{}, zh:{}, zu:{}}
};

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="token"]');

if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
	console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

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