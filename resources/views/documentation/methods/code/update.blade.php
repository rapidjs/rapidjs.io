<pre><code class="language-js">
var post = new Rapid({ modelName: 'Post' });

post.update(1, { title: 'An updated title' }).then(...) // config.methods.update => /api/post/1/[config.suffixes.update]

// alternatively you can send over only data if you'd prefer
post.update({ id: 1, title: 'An updated title' }).then(...) // config.methods.update => /api/post/[config.suffixes.update]
</code></pre>
