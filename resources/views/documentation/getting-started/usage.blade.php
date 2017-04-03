@include('components.heading', ['type' => 'h2', 'name' => 'usage', 'title' => 'Usage'])

<p>Out of the box rapid offers basic CRUD methods to make your requests: <code class="language-js">.create()</code>, <code class="language-js">.find()</code>, <code class="language-js">.update()</code>, <code class="language-js">.destroy()</code>. Imagine we have a blog post model that we want to perform these methods on. Normally, you'd need to define these endpoints one by one but with rapid they're built for you. </p>

@component('components.code')
import Rapid from 'rapid.js';

var Post = new Rapid({ modelName: 'post' });

Post.find(1).then(function (response) {
    // GET => /api/post/1
});

Post.create({ title: 'Rapidd is awesome!' }).then(...) // POST => /api/post/create

Post.update(23, { title: 'Rapid* is awesome!' }).then(...) // POST => /api/post/23/update

Post.destroy(1).then(...) // POST => /api/post/1/destroy
@endcomponent

<p>While this may seem quite trivial, rapid actually cuts out a large amount of time and repeating yourself. Without rapid, making these same requests might can be repetitive. Take the below example that uses only a framework such as <a href="#axios">Axios</a> alone (the backbone of rapid):</p>

@component('components.code')
import axios from 'axios';

axios.get('/api/post/1').then(...)
axios.post('/api/post/create', { data: { title: 'Rapidd is awesome!' } }).then(...)
axios.post('/api/post/update', { data: { title: 'Rapid* is awesome!' } }).then(...)
axios.post('/api/post/1/destroy').then(...)
@endcomponent

<p>The above example will work just fine for basic requests. But what if all your requests share a common <code class="language-js">baseURL</code> or <code class="language-js">API_KEY</code>? And what if you have a dozen similar models that ultimately make the same basic CRUD routes? This is where rapid comes in. You can define these once and use them among multiple rapid models without having to repeat yourself.</p>

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'find', 'text' => 'find()'],
    ['section' => 'method', 'key' => 'create', 'text' => 'create()'],
    ['section' => 'method', 'key' => 'update', 'text' => 'update()'],
    ['section' => 'method', 'key' => 'destroy', 'text' => 'destroy()']
]])
