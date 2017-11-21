<pre><code class="language-js">const category = new Rapid({ modelName: 'Category' });

category.id(45).withParam('name', 'featured').patch().then(function (response) {
    // PATCH => /api/tag/45
});
</code></pre>
