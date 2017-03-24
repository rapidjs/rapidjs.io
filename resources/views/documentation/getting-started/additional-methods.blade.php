@include('components.heading', ['type' => 'h2', 'name' => 'additional-methods', 'title' => 'Additional Methods'])

<p>In addition to simple CRUD rapid has a few other helper methods: <code class="language-js">.id()</code>, <code class="language-js">.all()</code>, <code class="language-js">.findBy()</code>.</p>

<pre><code class="language-js">// perform requests on a model with a certain id
Post.id(45).get('meta').then(...) // GET => /api/posts/45/meta
Post.id(55).withParams({ background: 'blue' }).post('meta').then(...) // POST => /api/posts/45/meta

// find a model by a key
Post.findBy('category', 'featured').then(...) // GET => /api/post/category/featured

// find a collection by a key
Post.collection.findBy('category', 'featured').then(...) // GET => /api/posts/category/featured

// request all of a collection
Post.all({ tag: 'awesome', limit: 20 }).then(...) // GET => /api/posts?tag=awesome&limit=20
</pre></code>

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'id', 'text' => 'id()'],
    ['section' => 'method', 'key' => 'findBy', 'text' => 'findBy()'],
    ['section' => 'method', 'key' => 'all', 'text' => 'all()']
]])
