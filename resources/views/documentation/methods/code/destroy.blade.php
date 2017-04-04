<pre><code class="language-js">var Photo = new rapid({ modelName: 'Photo' });

if(confirm("Are you sure you wanna delete this photo?")) {
    Post.destroy(1234).then(...) => // config.methods.destroy => /api/photo/1234/[config.suffixes.destroy]
}
</code></pre>
