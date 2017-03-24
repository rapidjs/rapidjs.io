@include('components.heading', ['type' => 'h2', 'name' => 'extending-auth-model', 'title' => 'The Rapid Auth Model'])

<pre><code class="language-js">import Auth from 'Rapid/Auth';
{{-- class User extends Auth {
    modelName:
} --}}

var User = new Auth({ modelName: 'auth' });

// and now you get

// come back to this and test

User.login({ username: 'drew', password: '1234pass' }).then(...) // POST => /api/
User.logout().then(...)
User.check().then(...) //
</code></pre>

<p>Changing the routes</p>
