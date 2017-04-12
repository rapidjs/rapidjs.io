<pre><code class="language-js">
var photoGallery = new Rapid({ modelName: 'PhotoGallery' });

photoGallery.create({ title: 'An Awesome Gallery!' }).then(...)
    // config.methods.create => /api/photo-galleries/[config.suffixes.create]
</code></pre>
