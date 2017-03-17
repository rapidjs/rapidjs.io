<pre><code class="language-js">import Auth from 'Rapid/Auth';
{{-- class User extends Auth {
    modelName:
} --}}

let user = new User({ modelName: 'auth' });

// and now you get

// come back to this and test

User.withParams({ username: 'drew', password: '1234pass' }).login().then(...) // POST => /api/
User.logout().then(...)
User.auth().then(...) //
</code></pre>
