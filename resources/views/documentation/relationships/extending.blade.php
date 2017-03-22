<h2 id="relationships-basic-usage">Extending Relationships</h2>

<p>While the above example can be helpful in some scenarios, you may find that you don't want to have to call the relationship method each time you want to request that specific route. In this case, you can extend rapid and define relationships in the <code class="language-js">boot()</code> method.</p>

<pre><code class="language-js">
    import Rapid from 'rapid.js';
    import PhotoGallery from './PhotoGallery';

    class User extends Rapid {
        boot () {
            this.addRelationship('hasMany', new Rapid({ modelName: 'Post' }));
            this.addRelationship('hasMany', PhotoGallery);
        }
    }

    export default new User({
        modelName: 'User'
    });

    import User from './Model/User';

    User.$rels.posts(34).get().then(...) // GET => /api/user/34/posts
    User.$rels.photo(34).get().then(...) // GET => /api/user/34/posts

    // you can also access relationships and their methods
    User.relationships.posts.find(23).then(...) // GET => /api/posts/34
</code></pre>

<p>Come back to this.</p>
