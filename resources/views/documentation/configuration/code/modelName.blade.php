<pre><code class="language-js">var Gallery = new Rapid({
    modelName: 'gallery'
});

Gallery.findBy('tag', 'featured') // => /api/posts/gallery/tag/featured
Gallery.collection.findBy('tag', 'featured') // => /api/posts/galleries/tag/featured
</code></pre>
