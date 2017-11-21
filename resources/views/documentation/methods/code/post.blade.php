<pre><code class="language-js">const gallery = new Rapid({ modelName: 'Gallery' });

gallery.id(23).withParams({ title: 'Appalachian Trail' }).post().then(function (response) {
    // POST => /api/gallery/23
});

gallery.withParams({ title: 'My Thru-Hike Photos' }).post('slug', 'appalachian-trail').then(...)
    // POST => /api/gallery/slug/appalachian-trail
</code></pre>
