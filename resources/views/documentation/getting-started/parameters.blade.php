<h2 id="parameters">Parameters</h2>

<p>With rapid, passing parameters is super easy for every request by using the <code class="language-js">.withParams()</code> and <code class="language-js">.withParam()</code>.</p>

<pre><code class="language-js">// pass multiple parameters
Post.withParams({ limit: 20 }).findBy('category', 'featured').then(...) // GET => /api/posts/category/featured?limit=20

// or just a single parameter
Post.withParam('status', 'published').findBy('user', 'self').then(...) // GET => /api/posts/user/self?status=published
</pre></code>

<h2 id="headers">Headers</h2>

<p>Passing headers is also super easy by using the <code class="language-js">.withHeaders()</code> and <code class="language-js">.withHeader()</code>.</p>

<pre><code class="language-js">// pass multiple headers
Post.withHeaders({'X-Requested-With': 'XMLHttpRequest'}).findBy(...)

// or just a single header
Post.withHeader('X-Requested-With', 'XMLHttpRequest').update(...)
</pre></code>
