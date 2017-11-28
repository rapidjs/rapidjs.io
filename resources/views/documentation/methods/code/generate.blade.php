<pre><code class="language-js">
import http from 'some-http-service';

const customRoutes = [
    {
        name: 'web_login',
        url: '/login'
    },

    {
        name: 'web_user_profile',
        url: '/user/profile/{username}'
    },

    {
        name: 'api_save_user_preferences',
        url: '/user/{id}/save/preferences'
    },
];

const rapid = new Rapid({ customRoutes, baseURL: '' });

rapid.generate('web_login')
// returns '/login'

// use your own service
http.post(rapid.generate('api_save_user_preferences'), { id: 1 }).then()...
</code></pre>

<p class="method__description">Similar to route, generate, well, generates a url based off a given name passed. However, it won't actually make the request for you. This is useful when using your own http service or appending urls to links. Below is an example of using it with something like <a href="https://vuejs.org" target="_blank">Vue</a>.</p>

<pre><code class="language-html">
    &lt;template&gt;
        &lt;div class="nav-component"&gt;
            &lt;a :href="router.generate('web_login')"&gt;Login&lt;/a&gt;
            &lt;a :href="router.generate('web_user_profile', { username: 'drew' })"&gt;Profile&lt;/a&gt;
        &lt;/div&gt;
    &lt;/template&gt;

    &lt;!-- renders to --&gt;

    &lt;div class="nav-component"&gt;
        &lt;a href="/login"&gt;Login&lt;/a&gt;
        &lt;a href="/user/profile/drew"&gt;Profile&lt;/a&gt;
    &lt;/div&gt;
</code></pre>