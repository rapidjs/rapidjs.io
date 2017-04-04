<pre><code class="language-js">var Category = new rapid({ modelName: 'Category' });

Category.id(56).delete().then(function (response) {
    // DELETE => /api/tag/56
});
</code></pre>
