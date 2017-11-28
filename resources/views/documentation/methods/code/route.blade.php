<pre><code class="language-js">
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

const router = new Rapid({ customRoutes, baseURL: '/api' });
</code></pre>

<p class="method__description">This method allows you to make requests to routes simply by calling it by name. You can define the <code class="language-js">name</code>, <code class="language-js">type</code>, and <code class="language-js">url</code> and rapid will do the rest. The below example fires a <code class="language-js">get</code> and <code class="language-js">post</code> request to the given routes.</p>

<pre><code class="language-js">
router.route('web_get_user_preferences').then((response) => {}); 
// GET => /api/user/preferences

router.route('web_save_user_preferences', { id: 12 }, /* { request data } */).then((response) => {}); 
// POST => /api/user/12/save/preferences
</code></pre>
