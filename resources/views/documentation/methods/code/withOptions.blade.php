<p>See <a href="#axios">Axios</a> for more info on the options that may be passed.</p>

<pre><code class="language-js">var Gallery = new rapid({ modelName: 'Gallery' });

Gallery.collection.withOptions({ maxRedirects: 5, maxContentLength: 2000 }).get('tags').then(...)
    // GET => /api/galleries/tags
</code></pre>
