<pre><code class="language-js">
var Post = new Rapid({ modelName: 'Post' });

Post.update(1, { title: 'An updated title' }).then(...) // config.methods.update => /api/post/1/[config.suffixes.update]

// alternatively you can send over only data if you'd prefer
Post.update({ id: 1, title: 'An updated title' }).then(...) // config.methods.update => /api/post/[config.suffixes.update]
</code></pre>
