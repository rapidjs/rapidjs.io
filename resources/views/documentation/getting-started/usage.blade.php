@include('components.heading', ['type' => 'h2', 'name' => 'usage', 'title' => 'Usage'])

<p>Out of the box rapid offers basic CRUD methods to make your requests: <code class="language-js">.create()</code>, <code class="language-js">.find()</code>, <code class="language-js">.update()</code>, <code class="language-js">.destroy()</code>. Imagine we have a blog post model that we want to perform these methods on. Normally, you'd need to define these endpoints one by one but with rapid they're built for you. </p>

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
