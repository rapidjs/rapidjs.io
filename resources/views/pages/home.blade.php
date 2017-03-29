@extends('layouts.master')

@section('content')

</div>

    <div class="home__hero" id="particles-js">

        @include('components.svg-grid')

        <div class="home__hero__inner">
            <div class="header">
                <div class="header__inner">
                    @include('components.logo')
                </div>
            </div>
            <h1 class="home__hero__title">A Fluent Interface To Rapidly Interact With APIs</h1>
            <h2 class="home__hero__subtitle">Create simple, resusable, and cleaner interfaces for your API requests that make sense.</h2>

            <a href="{{ route('docs') }}" class="rapid-btn">Get Started</a>

            <span class="bottom-arrow"><i class="fa fa-chevron-down"></i></span>
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
                    <h3>Easily Customize Your API Requests</h3>
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
                    <h3>Create Reusable Base Models</h3>
                    <div class="home__side-by-side__inner dark-block">
                        <pre>
                            <code class="language-js">
                                class Base extends Rapid {
                                    boot () {
                                        this.baseURL = 'https://myapp.com/api';
                                        this.config.globalParameters = { key: 'MY_API_KEY' }
                                    }
                                }

                                var Photo = new Base({ modelName: 'Photo' });
                                var Gallery = new Base({ modelName: 'Gallery' });
                                var Tag = new Base({ modelName: 'Tag' });

                                Photo.find(1)
                                    // GET => https://myapp.com/api/photo/1?key=MY_API_KEY

                                Tag.collection.findBy('color', 'red')
                                    // GET => https://myapp.com/api/tags/color/red?key=MY_API_KEY

                                Gallery.id(23).get('tags', 'nature')
                                    // GET => https://myapp.com/api/gallery/23/tag/nature?key=MY_API_KEY
                            </code>
                        </pre>
                    </div>
                </div>

                <div class="fb-grid col-xs-12 col-md-7 home__side-by-side__section">
                    <h3>Write API Wrappers For Your Endpoints</h3>
                    <div class="home__side-by-side__inner dark-block">
                        <pre>
                            <code class="language-js">
                                class GalleryWrapper extends Rapid {
                                    boot () {
                                        this.baseURL = 'https://myapp.com/gallery/api';
                                        this.modelName = 'Gallery';
                                    }

                                    tagSearch (query) {
                                        return this.url('tagsearch').withParam('query', query);
                                    }

                                    json () {
                                        return this.url('json');
                                    }
                                }

                                var Gallery = new GalleryWrapper({
                                    globalParameters: { key: 'MY_API_KEY' }
                                });

                                Gallery.tagSearch('nature').json().get().then(...);
                                    // GET https://myapp.com/gallery/api/tagsearch/json?query=nature&key=MY_API_KEY
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
