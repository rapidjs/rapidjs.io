<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre" rel="stylesheet">

        <title>rapid js - Write rapid js for frontend API development.</title>
    </head>
    <body>
        <div id="app">
            @include('layouts.header')

            <div class="wrapper" id="app">

                <div class="container fb-grid row">

                    @include('layouts.sidebar')

                    <div class="documentation fb-grid col-xs-12 col-md-10">

                    <h2 id="installation">Installation</h2>
                    <div><pre><code class="language-bash">npm i rapid-js --save</code></pre></div>
                    <div>

<h2 id="usage">Usage</h2>
<pre><code class="language-js">
import Rapid from 'rapidjs';

class Post extends Rapid {
    /**
     * Write something awesome.
     */
}

export default new Post();

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

User.auth().then((response) => {
    if(!response.data.loggedIn) {
        // login
    }
});

</code></pre>
                    </div>
                    <class-builder></class-builder>
                </div>
                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
