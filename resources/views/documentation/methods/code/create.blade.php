<pre><code class="language-js">
var PhotoGallery = new Rapid({ modelName: 'PhotoGallery' });

PhotoGallery.create({ title: 'An Awesome Gallery!' }).then(...)
    // config.methods.create => /api/photo-galleries/[config.suffixes.create]
</code></pre>
