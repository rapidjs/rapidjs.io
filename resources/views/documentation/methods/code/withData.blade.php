<p>In the example below, using <code class="language-js">data()</code> allows both params and options to be sent in the same method. See <a href="#axios">Axios</a> for more info on the options that may be passed.</p>

<pre><code class="language-js">var Gallery = new Rapid({ modelName: 'Gallery' });

Gallery.id(23).withData(params: { title: 'Appalachian Trail' }, options: { responseType: 'json' }).post().then(function (response) {
    // POST => /api/gallery/23
});
</code></pre>
