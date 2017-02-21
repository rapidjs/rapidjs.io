<pre><code class="language-js">var Post = new Rapid({ modelName: 'post' });

Post.findBy('category', 'featured').then(function (response) { // GET => /api/post/category/featured
    console.log(response.data.post);
});

Post.collection.findBy('category', 'featured').then(function (response) { // GET => /api/posts/category/featured
    console.log(response.data.post);
});
</code></pre>
