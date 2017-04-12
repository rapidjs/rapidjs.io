<pre><code class="language-js">
var post = new Rapid({ modelName: 'Post' });

post.id(45).get('meta').then(...); // GET => /api/post/45/meta
</code></pre>

<p class="method__description">If you set a <code class="language-js">primaryKey</code> in your config you it will also prefix that.</p>

<pre><code class="language-js">
var post = new Rapid({ modelName: 'Post', primaryKey: 'id' });

post.id(45).get('meta').then(...); // GET => /api/post/id/45/meta
</code></pre>
