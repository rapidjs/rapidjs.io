<pre><code class="language-js">var Photo = new rapid({ modelName: 'Photo' });

Photo.get().then(function (response) {
    // GET => /api/photo
});

Photo.get('tags').then(...) // GET => /api/photo/tags

Photo.collection.get('tag', 'hiking', 'recent').then(...) // GET => /api/photos/tag/hiking/recent

Photo.collection.get('tag', 'hiking', 'recent', 'page', 2).then(...) // GET => /api/photos/tag/hiking/recent/page/2
</code></pre>
