<h2 id="usage">Usage</h2>
<pre><code class="language-js">import Rapid from 'rapidjs';

var Post = new Rapid({ modelName: 'post' })
</pre></code>


<pre><code class="language-js">
Post.find(1).then(function (response) { // GET => /api/post/id/1
    console.log(response.data.post);
});

Post.model.findBy('slug', 'my-post-name').then(function (response) { // GET => /api/post/slug/my-post-name
    console.log(response.data.post);
});

Post.all({ category: 'featured', limit: 20 }).then(function (response) { // GET => /api/posts?category=featured&limit=20
    console.log(response.data.posts);
});

Post.collection.findBy('category', 'featured', { limit: 20 }).then(function (response) { // GET => /api/posts/category/featured?limit=20
    console.log(response.data.posts);
});
</pre></code>

<pre><code class="language-js">import { User } from 'rapidjs';

User.auth().then((response) => { // GET => /api/user/current
    if(!response.data.loggedIn) {
        // do something
    }
});

User.login({ name: user, password: password }).then((response) => { // POST => /api/user/login
    if(!response.data.error) {
        // login
    }
});

User.logout().then((response) => { // POST => /api/user/logout
    if(!response.data.error) {
        // login
    }
});

</code></pre>