import Vue from 'vue';
import axios from 'axios';
import prism from './Vendor/prism';
import Rapid from './Interface/Rapid/Rapid';
import Testies from './Interface/TestModel';

var Normalizer = require('prismjs/plugins/normalize-whitespace/prism-normalize-whitespace');

Prism.plugins.NormalizeWhitespace.setDefaults({
	'remove-trailing': true,
	'remove-indent': true,
	'left-trim': true,
	'right-trim': true,
	/*'break-lines': 80,
	'indent': 2,
	'remove-initial-line-feed': false,
	'tabs-to-spaces': 4,
	'spaces-to-tabs': 4*/
});

window.Vue = Vue;

window.rapidjs = Testies;

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
