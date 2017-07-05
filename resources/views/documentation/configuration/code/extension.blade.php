<pre><code class="language-js">var issues = new Rapid({
    modelName: 'issues',
    extension: 'json'
});

issues.get() // => /api/issues.json
issues.find(123) // => /api/issues/123.json
</code></pre>
