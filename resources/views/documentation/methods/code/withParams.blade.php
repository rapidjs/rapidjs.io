<pre><code class="language-js">var gallery = new Rapid({ modelName: 'Gallery' });

gallery.collection.withParams({ page: 1, order: 'asc' }).get('tags').then(...)
    // GET => /api/galleries/tags?page=1&order=asc

// withParams can be chained and used with all CRUD methods
gallery.withParams({ title: 'My Thru-Hike Photos' }).update().then(...)
    // config.methods.update => /api/gallery/slug/appalachian-trail
</code></pre>
