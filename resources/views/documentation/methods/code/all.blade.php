<pre><code class="language-js">var Post = new Rapid({ modelName: 'post' });

Post.all().then(function (response) { // GET => /api/posts
    console.log(response.data.post);
});

Post.withParams({ category: 'featured', limit: 20 }).all().then(function (response) { // GET => /api/posts?category=featured&limit=20
    console.log(response.data.post);
});
</code></pre>
