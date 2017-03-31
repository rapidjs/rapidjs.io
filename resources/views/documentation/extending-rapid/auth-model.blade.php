@include('components.heading', ['type' => 'h2', 'name' => 'extending-auth-model', 'title' => 'The Rapid Auth Model'])

<p>Rapid offers a simple auth model that gives you some basic auth routes out of the box.</p>

<pre><code class="language-js">import Auth from 'rapid/auth';

var User = new Auth({ modelName: 'User' });

// and now you get

// come back to this and test

User.login({ username: 'drew', password: '1234pass' }).then(...) // POST => /api/
User.logout().then(...)
User.check().then(...) //
</code></pre>

<p>Changing the routes</p>
