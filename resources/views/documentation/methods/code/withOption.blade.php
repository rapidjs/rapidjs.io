<p>See <a href="#axios">Axios</a> for more info on the options that may be passed.</p>

<pre><code class="language-js">const gallery = new Rapid({ modelName: 'Gallery' });

gallery.collection.withOption('maxRedirects', 5).get('tags').then(...)
    // GET => /api/galleries/tags
</code></pre>
