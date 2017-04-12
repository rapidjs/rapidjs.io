<pre><code class="language-js">var category = new Rapid({ modelName: 'Category' });

category.id(56).delete().then(function (response) {
    // DELETE => /api/tag/56
});
</code></pre>
