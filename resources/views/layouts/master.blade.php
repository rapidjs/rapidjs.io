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
                {{-- <div class="sidebar">

                </div> --}}

                <div class="container">
                    <div><pre><code class="language-bash">npm i rapid-js --save</code></pre></div>
                    <div>
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

Post.findBy('slug', 'my-post-name').then(function (response) { // GET => /api/post/slug/my-post-name
    console.log(response.data.post);
});

Post.all({ category: 'featured', limit: 20 }).then(function (response) { // GET => /api/posts?category=featured&limit=20
    console.log(response.data.posts);
});

Post.findAllBy('category', 'featured', { limit: 20 }).then(function (response) { // GET => /api/posts/category/featured?limit=20
    console.log(response.data.posts);
});





</code></pre>
                    </div>
                    <class-builder></class-builder>
                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
