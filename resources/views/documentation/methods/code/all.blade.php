<pre><code class="language-js">var post = new Rapid({ modelName: 'post' });

post.all().then(function (response) {
    // GET => /api/posts
});

post.withParams({ category: 'featured', limit: 20 }).all().then(function (response) {
    // GET => /api/posts?category=featured&limit=20
});
</code></pre>
