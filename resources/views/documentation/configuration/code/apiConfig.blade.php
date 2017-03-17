<pre><code class="language-js">var Fish = new Rapid({
    modelName: 'fish',
    apiConfig: {

    }
})</code></pre>

You can also access axios config by doing the following:
<pre><code class="language-js">window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};</code></pre>
