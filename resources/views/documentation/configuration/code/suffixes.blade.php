<pre><code class="language-js">var Fruit = new Rapid({
    modelName: 'fruit',
    {
        create  : 'new',
        update  : 'save',
        destroy : 'delete',
    }
});

Fruit.create({}) // => /api/fruit/new
Fruit.update(1, {}) // => /api/fruit/1/save
Fruit.destroy(1) // => /api/fruit/1/delete
</code></pre>
