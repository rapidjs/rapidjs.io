<pre><code class="language-js">var Post = new rapid({ modelName: 'post' });

Post.findBy('category', 'featured').then(function (response) {
    // GET => /api/post/category/featured
});

Post.collection.findBy('category', 'featured').then(function (response) {
    // GET => /api/posts/category/featured
});
</code></pre>
