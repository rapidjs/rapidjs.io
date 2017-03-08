<pre><code class="language-js">var Gallery = new Rapid({
    modelName: 'gallery'
});

Gallery.findBy('tag', 'featured') // => /api/posts/gallery/tag/featured
Gallery.collection.findBy('tag', 'featured') // => /api/posts/galleries/tag/featured

// using a camel case name
var Gallery = new Rapid({
    modelName: 'PhotoGallery'
});

Gallery.findBy('tag', 'featured') // => /api/posts/photo-gallery/tag/featured
Gallery.collection.findBy('tag', 'featured') // => /api/posts/photo-galleries/tag/featured
</code></pre>
