<pre><code class="language-js">var Tag = new rapid({ modelName: 'Tag' });

Tag.id(45).withParam('name', 'hiking').put().then(function (response) {
    // PUT => /api/tag/45
});
</code></pre>
