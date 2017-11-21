If you were to call a non route-specific method such as <code class="language-js">.findBy()</code> it would use the <code class="language-markdown">`model`</code> route.

<pre><code class="language-js">const post = new Rapid({
    modelName: 'post'
});

post.findBy('key', 'value') // => GET /api/post/key/value
post.collection.findBy('key', 'value') // => GET /api/posts/key/value
</code></pre>

Setting the default route to collection would set collection to the default route instead:

<pre><code class="language-js">const post = new Rapid({
    modelName: 'post',
    defaultRoute: 'collection'
});

post.findBy('key', 'value') // => GET /api/posts/key/value
post.model.findBy('key', 'value') // => GET /api/post/key/value
</code></pre>
