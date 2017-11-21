@include('components.heading', ['type' => 'h2', 'name' => 'custom-routes', 'title' => 'Custom Routes'])

<p>Though rapid works its magic and makes your requests super simple with almost no configuration, you may find that it's not enough for places where you have a whole load of routes. This is where <b>Custom Routes</b> save the day!</p>

<p>Custom routes allow you define a list of routes containing a <code class="language-js">name</code>, <code class="language-js">type</code> of request, and of course, a <code class="language-js">url</code>. It can either make a request for you, or just generate the path. It's up to you! Nonetheless, rapid helps!</p>

<p>The first step is really to define your routes like below:</p>
@component('components.code')
const customRoutes = [
    {
        name: 'web_get_user_preferences',
        type: 'get',
        url: '/user/preferences',
    },

    {
        name: 'web_save_user_preferences',
        type: 'post',
        url: '/user/{id}/save/preferences'
    }
];
@endcomponent

<p>Next, initialize your routes and set a baseURL.</p>
@component('components.code')
import customRoutes from './custom-routes';

const router = new Rapid({ customRoutes, baseURL: '/api' });
@endcomponent

<p>That's it! Now you can make a request or simply generate a url to pass to your own http service.</p>
@component('components.code')
router.route('web_get_user_preferences').then((response) => {}); 
// GET => /api/user/preferences

router.route('web_save_user_preferences', { id: 12 }, /* { request data } */).then((response) => {}); 
// POST => /api/user/12/save/preferences
@endcomponent

<p>Below is an example of using your own http service:</p>
@component('components.code')
import 'http' from 'some-http-service';

const customRoutes = [
    {
        name: 'web_login',
        url: '/login'
    },

    {
        name: 'api_save_user_preferences',,
        url: '/user/{id}/save/preferences'
    }
];

const rapid = new Rapid({ customRoutes, baseURL: '' });

rapid.generate('web_login')
// returns '/login'

// use your own service
http.post(rapid.generate('api_save_user_preferences'), { id: 1 }).then()...
@endcomponent

@include('components.see-also', ['routes' => [
    ['section' => 'configuration', 'key' => 'baseURL', 'text' => 'baseURL'],
    ['section' => 'methods', 'key' => 'generate', 'text' => 'generate'],
    ['section' => 'methods', 'key' => 'route', 'text' => 'route'],
]])