<h2 id="parameters">Parameters</h2>

<p>With rapid, passing parameters is super easy for every request by using the <code class="language-js">.withParams()</code> and <code class="language-js">.withParam()</code>.</p>

<pre><code class="language-js">Post.withParams({ limit: 20 }).findBy('category', 'featured').then(function (response) {
    // GET => /api/posts/category/featured?limit=20
});

Post.withParam('status', 'published').findBy('user', 'self').then(function (response) {
    // GET => /api/posts/user/self?status=published
});
</pre></code>
