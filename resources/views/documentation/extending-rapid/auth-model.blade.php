@include('components.heading', ['type' => 'h2', 'name' => 'extending-auth-model', 'title' => 'The Rapid Auth Model'])

<p>Rapid offers a simple auth model that provides some basic auth routes out of the box. You can make new <code class="language-js">Auth</code> model that will take all the same config as a rapid model in addition to the following auth options: </p>

@component('components.code')
auth: {
    routes: {
        login    : 'login',   // a route to login a user
        logout   : 'logout',  // a route to logout a user
        auth     : 'auth',    // a route to check for auth
        register : 'register' // a route to check for auth
    },

    methods: {
        login    : 'post', // the method to use for login
        logout   : 'post', // the method to use for logout
        auth     : 'get',   // the method to use for auth
        register : 'post'  // the method to use for auth
    },

    modelPrefix: false // whether or not to prefix the model name in the requests
}
@endcomponent

<p>With only a <code class="language-js">modelName</code> passed, you can get the following routes:</p>

@component('components.code')
import { Auth } from 'rapid.js';

var User = new Auth({ modelName: 'User' });

User.login({ username: 'user', password: 'password' }).then(...) // config.auth.methods.login => /api/login
User.logout().then(...) // config.auth.methods.logout => /api/logoout
User.check().then(...) // config.auth.methods.auth => /api/auth
User.register({ name: 'rapid', email: 'user@email.com', password: 'password' }).then(...) // config.auth.methods.register => /api/register

// all regular methods are still available too
User.find(1).then(...) // GET => /api/user/1
@endcomponent

<p>Like a basic rapid model, you can customize the auth routes and methods to fit your API like so:</p>

@component('components.code')
var User = new Auth({
    modelName: 'User',
    auth: {
        routes: {
            auth: 'authenticate',
            register: 'sign-up'
        },
        modelPrefix: true
    }
});

User.login({ username: 'user', password: 'password' }).then(...) // config.auth.methods.login => /api/user/login
User.logout().then(...) // config.auth.methods.logout => /api/user/logoout
User.check().then(...) // config.auth.methods.auth => /api/user/authenticate
User.register({ name: 'rapid', email: 'user@email.com', password: 'password' }).then(...) // config.auth.methods.register => /api/user/sign-up
@endcomponent
