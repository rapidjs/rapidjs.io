<h2 id="usage">Usage</h2>

<p>Out of the box rapid offers basic CRUD methods in our case: <code class="language-js">.create()</code>, <code class="language-js">.find()</code>, <code class="language-js">.update()</code>, <code class="language-js">.destroy()</code>. Imagine we have a blog post model that we want to perform these methods on.</p>

<pre><code class="language-js">import Rapid from 'rapid.js';

var Post = new Rapid({ modelName: 'post' });

Post.find(1).then(function (response) {
    // GET => /api/post/1
});

Post.create({ title: 'Rapidd is awesome!' }).then(...) // POST => /api/post/create

Post.update(23, { title: 'Rapid* is awesome!' }).then(...) // POST => /api/post/23/update

Post.destroy(1).then(...) // POST => /api/post/1/destroy
</pre></code>

<h3 id="additional-methods">Additional Methods</h3>

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

{{-- <pre><code class="language-js">import { User } from 'rapidjs';

User.auth().then(function (response) { // GET => /api/user/current
    if(!response.data.loggedIn) {
        // do something
    }
});

User.login({ name: user, password: password }).then(function (response) { // POST => /api/user/login
    if(!response.data.error) {
        // login
    }
});

User.logout().then(function (response) { // POST => /api/user/logout
    if(!response.data.error) {
        // login
    }
});

</code></pre> --}}
