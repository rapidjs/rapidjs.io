import Vue from 'vue';
import axios from 'axios';
import prism from './Vendor/prism';
import Rapid from './Interface/Rapid/Rapid';

window.Vue = Vue;

window.rapidjs = new Rapid({
    modelName: 'user',
    debug: false
});

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
