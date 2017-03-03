@extends('layouts.master')

@section('content')

</div>

    <div class="home__hero">

        @include('components.svg-grid')

        <div class="home__hero__inner">
            <h1 class="home__hero__title">Rapidly Interact With APIs</h1>
            <h1 class="home__hero__subtitle">Create simple, resusable, and cleaner interfaces to for your API calls that make sense.</h1>

            <a href="{{ route('docs') }}" class="rapid-btn">Get Started</a>
        </div>
    </div>

    <div class="home__callout">
        <div class="home__callout__inner wrapper">
            <div class="container fb-grid row home__callout__logos">
                @foreach (config('logos') as $logo)
                    <div class="home__callout__logo">
                        <a target="_blank" href="{{ $logo['url'] }}">
                            <img src="/images/{{ $logo['logo'] }}" alt="{{ $logo['name'] }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="home__inner">
        @include('components.svg-grid')

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

                                Post.update(25, { title: 'Rapid JS Is Awesome!' })
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

                                Post.update(25, { title: 'Rapid JS Is Awesome!' })
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

    <div class="home__callout">
        <div class="home__callout__inner wrapper">
            <div class="container fb-grid row home__callout__inner">

                <div class="home__callout__logo home__callout__logo--with-text">
                    <span>View the project on</span>

                    <a target="_blank" href="https://github.com/drewjbartlett/rapidjs">
                        <img src="/images/github-logo.png" alt="Github">
                    </a>
                </div>

                <span class="home__callout__or">or</span>

                <span class="home__callout__action">
                    <a href="{{ route('docs') }}" class="rapid-btn rapid-btn--med">Read the Docs</a>
                </span>

            </div>
        </div>
    </div>

    <div class="home__inner">
        @include('components.svg-grid')

        <div class="home wrapper">
            <div class="container fb-grid row home__side-by-side">
                <div class="fb-grid col-xs-12 col-md-5  home__side-by-side__section home__side-by-side__section--lowered">
                    <h3>Access Simple Relationships</h3>
                    <div class="home__side-by-side__inner dark-block">
                        <pre>
                            <code class="language-js">
                                var Post    = new Rapid({ modelName: 'post' }),
                                    Comment = new Rapid({ modelName: 'Comment' }),
                                    Author  = new Rapid({ modelName: 'post' });

                                Post.belongsTo(Author, 23).get()
                                    // GET => /api/author/23/posts

                                Post.hasMany(Comment, 45).get()
                                    // GET => /api/post/45/comments

                                Comment.belongsTo(Post, 45).get()
                                    // GET => /api/post/45/comments

                                Comment.hasOne(Author, 12345).get()
                                    // GET => /api/comment/12345/author

                                Author.hasMany(Post, 'drew').get()
                                    // GET /api/author/drew/posts
                            </code>
                        </pre>
                    </div>
                </div>

                <div class="fb-grid col-xs-12 col-md-7 home__side-by-side__section">
                    <h3>Or Extend Rapid For Reusable Relationships</h3>
                    <div class="home__side-by-side__inner dark-block">
                        <pre>
                            <code class="language-js">
                                import Photo from './Model/Photo';

                                class Gallery extends Rapid {
                                    boot () {
                                        this.addRelationship('hasMany', Photo);
                                        this.addRelationship('hasOne', new Rapid({ modelName: 'user' }));
                                    }
                                }

                                var Gallery = new Gallery({ modelName: 'gallery' });

                                Gallery.photos(234).get() // GET => /api/gallery/234/photos

                                Gallery.user(234).get() // GET => /api/gallery/234/user


                                /* access relationship methods */
                                Gallery.relationships.user.find(123) // GET => /api/user/123

                                Gallery.relationships.photos.delete(567) // GET => /api/photos/567
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
