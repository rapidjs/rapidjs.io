<pre><code class="language-js">const post = new Rapid({ modelName: 'post' });

post.findBy('category', 'featured').then(function (response) {
    // GET => /api/post/category/featured
});

post.collection.findBy('category', 'featured').then(function (response) {
    // GET => /api/posts/category/featured
});
</code></pre>
