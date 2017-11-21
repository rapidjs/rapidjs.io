Without using a primaryKey requests would look like:
<pre><code class="language-js">post.find(1) // => GET /api/post/1
post.update(123) // => POST /api/post/123/update
post.destroy(987) // => POST /api/post/987/destroy
</code></pre>

<span class="documentation__note">With the following config you'll notice the primaryKey <code class="language-markdown">`id`</code> is included in the urls</span>

<pre><code class="language-js">const post = new Rapid({
    modelName: 'post',
    primaryKey: 'id',
});

post.find(1) // => GET /api/post/id/1
post.update(123, {}) // => POST /api/post/id/123/update
post.destroy(987) // => POST /api/post/id/987/destroy
</code></pre>
