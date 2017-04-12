<pre><code class="language-js">var photo = new Rapid({ modelName: 'Photo' });

photo.get().then(function (response) {
    // GET => /api/photo
});

photo.get('tags').then(...) // GET => /api/photo/tags

photo.collection.get('tag', 'hiking', 'recent').then(...) // GET => /api/photos/tag/hiking/recent

photo.collection.get('tag', 'hiking', 'recent', 'page', 2).then(...) // GET => /api/photos/tag/hiking/recent/page/2
</code></pre>
