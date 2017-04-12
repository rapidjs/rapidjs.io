<pre><code class="language-js">var gallery = new Rapid({
    modelName: 'gallery'
});

gallery.findBy('tag', 'featured') // => /api/posts/gallery/tag/featured
gallery.collection.findBy('tag', 'featured') // => /api/posts/galleries/tag/featured

// using a camel case name
var gallery = new Rapid({
    modelName: 'PhotoGallery'
});

gallery.findBy('tag', 'featured') // => /api/posts/photo-gallery/tag/featured
gallery.collection.findBy('tag', 'featured') // => /api/posts/photo-galleries/tag/featured
</code></pre>
