

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
// import jQuery from 'jquery';
// window.$ = jQuery;
// window.jQuery = jQuery;

// window.$ = window.jQuery;

// // import 'jquery-ui';

// import 'bootstrap';

// import 'jquery-validation';

// import 'datatables.net-bs4';
// import select2 from 'select2';
// select2();

import '../../node_modules/jquery/dist/jquery.js';
import '../../node_modules/jquery-ui/dist/jquery-ui.js';
import '../../node_modules/bootstrap/dist/js/bootstrap.js';
import '../../node_modules/jquery-validation/dist/jquery.validate.js';

import '../../node_modules/datatables.net/js/dataTables.js';
import '../../node_modules/select2/dist/js/select2.js';

import swal from 'sweetalert2';
window.Swal = swal;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

