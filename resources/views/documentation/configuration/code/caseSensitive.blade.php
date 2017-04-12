By default, routes would be:
<pre><code class="language-js">myModel.find(1) // => GET /api/my-model/1
myModel.all() // => GET /api/my-models
</code></pre>

Notice below that the urls will have case sensitive model and collection routes.
<pre><code class="language-js">var myModel = new Rapid({
    modelName: 'MyModel',
    caseSensitive: true
});

myModel.find(1) // => GET /api/MyModel/1
myModel.all() // => GET /api/MyModels
</code></pre>
