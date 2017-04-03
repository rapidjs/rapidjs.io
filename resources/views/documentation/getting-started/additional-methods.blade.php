@include('components.heading', ['type' => 'h2', 'name' => 'additional-methods', 'title' => 'Additional Methods'])

<p>In addition to simple CRUD rapid has a few other helper methods: <code class="language-js">.id()</code>, <code class="language-js">.all()</code>, <code class="language-js">.findBy()</code>.</p>

@component('components.code')
// perform requests on a model with a certain id
Post.id(45).get('meta').then(...) // GET => /api/posts/45/meta
Post.id(55).withParams({ background: 'blue' }).post('meta').then(...) // POST => /api/posts/45/meta
@endcomponent

<p>Rapid takes a <code class="language-js">primaryKey</code> attribute in its config. If you were to provide one, <code class="language-js">.id()</code> will also account for that.</p>

@component('components.code')
var Post = new Rapid({ modelName: 'Post', primaryKey: 'id' });

Post.id(45).get('meta').then(...) // GET => /api/posts/id/45/meta
Post.id(55).withParams({ background: 'blue' }).post('meta').then(...) // POST => /api/posts/id/45/meta
@endcomponent

<p>Lastly, <code class="language-js">.all()</code> and <code class="language-js">.findBy()</code> can be used to make simple requests to either find a model or collection by a key/value pair or to find all of a collection.</p>

@component('components.code')
// find a model by a key
Post.findBy('category', 'featured').then(...) // GET => /api/post/category/featured

// find a collection by a key
Post.collection.findBy('category', 'featured').then(...) // GET => /api/posts/category/featured

// request all of a collection
Post.withParams({ tag: 'awesome', limit: 20 }).all().then(...) // GET => /api/posts?tag=awesome&limit=20
@endcomponent

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'id', 'text' => 'id()'],
    ['section' => 'method', 'key' => 'findBy', 'text' => 'findBy()'],
    ['section' => 'method', 'key' => 'all', 'text' => 'all()']
]])
