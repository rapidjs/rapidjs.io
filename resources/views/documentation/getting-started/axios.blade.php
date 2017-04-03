@include('components.heading', ['type' => 'h2', 'name' => 'axios', 'title' => 'Axios'])

<p>Under the hood rapid takes advantage of the promised-based framework <a href="https://github.com/mzabriskie/axios" target="_blank">axios</a>. To better understand any api configuration have a look at their <a href="https://github.com/mzabriskie/axios" target="_blank">documentation</a>. Though it would defeat the purpose of rapid can still access and use axios directly via <code class="language-js">this.api</code>.</p>

<pre><code class="language-js">var Photo = new Rapid({ modelName: 'photo' });

Photo.api.get('/api/photos/1');
</code></pre>

@include('components.see-also', ['routes' => [
    ['section' => 'configuration', 'key' => 'apiConfig', 'text' => 'apiConfig']
]])
