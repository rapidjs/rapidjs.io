By default, routes would be:
<pre><code class="language-js">MyModel.find(1) // => GET /api/my-model/1
MyModel.all() // => GET /api/my-models
</code></pre>

Notice below that the urls will have case sensitive model and collection routes.
<pre><code class="language-js">var MyModel = new Rapid({
    modelName: 'MyModel',
    caseSensitive: true
});

MyModel.find(1) // => GET /api/MyModel/1
MyModel.all() // => GET /api/MyModels
</code></pre>
