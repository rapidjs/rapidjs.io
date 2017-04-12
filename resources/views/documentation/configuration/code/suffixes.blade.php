<pre><code class="language-js">var fruit = new Rapid({
    modelName: 'fruit',
    {
        create  : 'new',
        update  : 'save',
        destroy : 'delete',
    }
});

fruit.create({}) // => /api/fruit/new
fruit.update(1, {}) // => /api/fruit/1/save
fruit.destroy(1) // => /api/fruit/1/delete
</code></pre>
