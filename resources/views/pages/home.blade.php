@extends('layouts.master')

@section('content')

</div>

    <div class="home__hero">
        <div class="home__hero__grid">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="30" height="30" patternUnits="userSpaceOnUse">
                        <rect width="30" height="30" fill="url(#smallGrid)"/>
                        <path d="M 30 0 L 0 0 0 30" fill="none" stroke="#414a59" stroke-width=".5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="home__hero__inner">
            <h1 class="home__hero__title">Rapidly Interact With APIs</h1>
            <h1 class="home__hero__subtitle">Create simple, resusable, and cleaner interfaces to for your API calls that just make sense.</h1>

            <a href="{{ route('docs') }}" class="home__hero__btn">Get Started</a>
        </div>
    </div>

    <div class="home__callout">

    </div>

    <div class="home__inner">

        <div class="home wrapper">

            <div class="container fb-grid row home__side-by-side">
                <div class="fb-grid col-xs-12 col-md-7  home__side-by-side__section">
                    <h3>Define Simple Models</h3>
                    <div class="home__side-by-side__inner dark-block">
                        <pre>
                            <code class="language-js">
                                var Post = new Rapid({ modelName: 'Post' });

                                Post.find(1).then((response) => {
                                    // GET => /api/post/1
                                });

                                Post.collection.findBy('category', 'featured').then((response) => {
                                    // GET => /api/posts/category/featured
                                });

                                Post.withParams({ limit: 20, order: 'desc' }).all().then((response) => {
                                    // GET => /api/posts?limit=20&order=desc
                                });

                                Post.update(25, { name: 'Rapid JS Is Awesome' })
                                    // POST => /api/posts/25/update

                                Post.destroy(9)
                                    // POST => /api/posts/9/destroy
                            </code>
                        </pre>
                    </div>
                </div>

                <div class="fb-grid col-xs-12 col-md-5 home__side-by-side__section home__side-by-side__section--lowered">
                    <h3>Easily Customize Your API Calls</h3>
                    <div class="home__side-by-side__inner dark-block">
                        <pre>
                            <code class="language-js">
                                var Post = new Rapid({
                                    modelName: 'Post',
                                    suffixes: {
                                        destroy: '',
                                        update: 'save'
                                    },
                                    methods: {
                                        destroy: 'delete'
                                    },
                                    trailingSlash: true
                                 });

                                Post.update(25, { name: 'Rapid JS Is Awesome' })
                                    // POST => /api/posts/25/save/

                                Post.destroy(9)
                                    // DELETE => /api/posts/9/
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection




        {{-- <div class="fb-grid col-xs-12 col-md-6">
            <h3>Extend Rapid</h3>

            <pre><code class="language-js">


import Photo from './Model/Photo';

class Gallery extends Rapid {
boot () {
    this.addRelationship('hasMany', Photo);
    this.addRelationship('hasOne', new Rapid({ modelName: 'user' }));
}
}

Gallery.photos(234).get() // GET => /api/gallery/234/photos

Gallery.user(234).get() // GET => /api/gallery/234/user

// access relationship methods
Gallery.relationships.user.find(123) // GET => /api/user/123

            </code></pre>
        </div> --}}
