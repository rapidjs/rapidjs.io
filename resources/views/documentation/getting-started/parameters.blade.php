@include('components.heading', ['type' => 'h2', 'name' => 'parameters', 'title' => 'Parameters'])

<p>With rapid, passing parameters is super easy for every request by using the <code class="language-js">.withParams()</code> and <code class="language-js">.withParam()</code>.</p>

<pre><code class="language-js">// pass multiple parameters
Post.collection.withParams({ limit: 20 }).findBy('category', 'featured').then(...)
    // GET => /api/posts/category/featured?limit=20

// or just a single parameter
Post.collection.withParam('status', 'published').findBy('user', 'self').then(...)
     // GET => /api/posts/user/self?status=published
</pre></code>

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'withParams', 'text' => 'withParams()'],
    ['section' => 'method', 'key' => 'withParam', 'text' => 'withParam()']
]])
