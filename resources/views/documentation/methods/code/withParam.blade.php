<pre><code class="language-js">var Gallery = new rapid({ modelName: 'Gallery' });

Gallery.collection.withParam('page', 1).get('tags').then(...)
    // GET => /api/galleries/tags?page=1

Gallery.withParam('title', 'My Thru-Hike Photos').update().then(...)
    // config.methods.update => /api/gallery/slug/appalachian-trail
</code></pre>
