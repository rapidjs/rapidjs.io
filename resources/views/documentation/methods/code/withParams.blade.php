<pre><code class="language-js">var Gallery = new rapid({ modelName: 'Gallery' });

Gallery.collection.withParams({ page: 1, order: 'asc' }).get('tags').then(...)
    // GET => /api/galleries/tags?page=1&order=asc

// withParams can be chained and used with all CRUD methods
Gallery.withParams({ title: 'My Thru-Hike Photos' }).update().then(...)
    // config.methods.update => /api/gallery/slug/appalachian-trail
</code></pre>
