<pre><code class="language-js">var Gallery = new rapid({ modelName: 'Gallery' });

Gallery.id(23).withParams({ title: 'Appalachian Trail' }).post().then(function (response) {
    // POST => /api/gallery/23
});

Gallery.withParams({ title: 'My Thru-Hike Photos' }).post('slug', 'appalachian-trail').then(...)
    // POST => /api/gallery/slug/appalachian-trail
</code></pre>
