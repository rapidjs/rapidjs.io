<h2 id="usage">Basic Usage</h2>
<pre><code class="language-js">import Rapid from 'rapid.js';

// assume we have a blog post model
var Post = new Rapid({ modelName: 'post' });

Post.find(1).then(function (response) {
    // GET => /api/post/1
});

Post.create({ title: 'Rapidd is awesome!' }).then(function (response) {
    // POST => /api/post/create
});

Post.update(23, { title: 'Rapid* is awesome!' }).then(function (response) {
    // POST => /api/post/23/update
});

Post.destroy(1).then(function (response) {
    // POST => /api/post/1/destroy
});
</pre></code>

// model only
// collection only
// relationships

{{-- <p>rapid also has some awesome helper functions</p>

<pre><code class="language-js">Post.findBy('category', 'featured').then(function (response) {
    // GET => /api/posts/category/featured
});

Post.all({ category: 'featured', limit: 20 }).then(function (response) {
    // GET => /api/posts?category=featured&limit=20
});
</pre></code> --}}


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
