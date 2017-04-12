<pre><code class="language-js">var gallery = new Rapid({ modelName: 'Gallery' });

gallery.collection.withParam('page', 1).get('tags').then(...)
    // GET => /api/galleries/tags?page=1

gallery.withParam('title', 'My Thru-Hike Photos').update().then(...)
    // config.methods.update => /api/gallery/slug/appalachian-trail
</code></pre>
