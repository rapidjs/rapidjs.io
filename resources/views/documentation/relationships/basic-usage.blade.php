@include('components.heading', ['type' => 'h2', 'name' => 'relationships-basic-usage', 'title' => 'Basic Usage'])

<p>Firstly, I am no relationship expert-that's for sure. (Writing docs takes a while...have to make it fun, right?). Anyway, like many popular backend frameworks such as <a href="https://laravel.com?ref=rapid">Laravel</a>, you can define relationships. Actually rapid is inspired by Laravel's relationships. Behind the scenes, rapid is just generating URLs that would make sense for a relationship. If your app is more complex and you want to define some relationships, you can do so with the methods: <code class="language-js">hasOne()</code>, <code class="language-js">hasMany()</code>, <code class="language-js">belongsTo()</code>, <code class="language-js">belongsToMany()</code>. Let's take the simple example of a blog post which has comments and an author.</p>

<pre><code class="language-js">
    var Post = new Rapid({
            modelName: 'Post'
        }),
        Comment = new Rapid({
            modelName: 'Comment'
        }),
        Author = new Rapid({
            modelName: 'Author'
        });

    Post.hasOne(Author, 123).get().then(...) // GET => /api/post/123/author
    Post.hasOne('author', 123).get().then(...) // alternatively, you can pass a string for the same result

    Post.hasMany(Comment, 456).get().then(...) // GET => /api/post/456/comments

    Comment.collection.belongsTo('post', 1234).get()then(...); // GET => /api/post/1234/comments

    Author.belongsToMany(Post, 23).get()then(...); // GET => /api/posts/author/23
</code></pre>

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'hasOne', 'text' => 'hasOne()'],
    ['section' => 'method', 'key' => 'hasMany', 'text' => 'hasMany()'],
    ['section' => 'method', 'key' => 'belongsTo', 'text' => 'belongsTo()'],
    ['section' => 'method', 'key' => 'belongsToMany', 'text' => 'belongsToMany()']
]])
