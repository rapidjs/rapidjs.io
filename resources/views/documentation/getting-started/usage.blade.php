<h2 id="usage">Usage</h2>

<p>Out of the box rapid offers basic CRUD methods in our case: <code class="language-js">.create()</code>, <code class="language-js">.find()</code>, <code class="language-js">.update()</code>, <code class="language-js">.destroy()</code>. With little to no Imagine we have a blog post model that we want to perform these methods on.</p>

<pre><code class="language-js">import Rapid from 'rapid.js';

var Post = new Rapid({ modelName: 'post' });

Post.find(1).then(function (response) {
    // GET => /api/post/1
});

Post.create({ title: 'Rapidd is awesome!' }).then(...) // POST => /api/post/create

Post.update(23, { title: 'Rapid* is awesome!' }).then(...) // POST => /api/post/23/update

Post.destroy(1).then(...) // POST => /api/post/1/destroy
</pre></code>

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'find', 'text' => 'find()'],
    ['section' => 'method', 'key' => 'create', 'text' => 'create()'],
    ['section' => 'method', 'key' => 'update', 'text' => 'update()'],
    ['section' => 'method', 'key' => 'destroy', 'text' => 'destroy()']
]])
