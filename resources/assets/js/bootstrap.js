import Vue from 'vue';
import axios from 'axios';
import prism from './Vendor/prism';
import Rapid from './Interface/Rapid/Rapid';
import Testies from './Interface/TestModel';
import Gallery from './Interface/Gallery';
import Googs from './Interface/GoogleMapsPlaces';
import Auth from './Interface/Rapid/Models/Auth';
import AutoComplete from './Components/AutoComplete';
import $ from 'jquery';
import 'particles.js/particles';

window.$ = $;
window.Vue = Vue;
window.rapidjs = Testies;
window.googs = Googs;
window.auth = new Auth();
window.Gallery = Gallery;

//
// $(function () {
// 	$('.sidebar a[href^="' + location.hash + '"]').addClass('active-nav');
//
// 	$('.sidebar a').on('click', (e) => {
// 		let current = $(e.currentTarget);
//
// 		$('.sidebar a').each((k, nav) => { $(nav).removeClass('active-nav'); });
//
// 		current.addClass('active-nav');
// 	});
// });



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


/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};

const particlesJS = window.particlesJS;

let particles = document.getElementById('particles-js');

if(particles) {
	particlesJS.load('particles-js', '/assets/particles.json', function () {});
}
