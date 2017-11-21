<pre><code class="language-js">const photo = new Rapid({ modelName: 'Photo' });

if(confirm("Are you sure you wanna delete this photo?")) {
    photo.destroy(1234).then(...) => // config.methods.destroy => /api/photo/1234/[config.suffixes.destroy]
}
</code></pre>
