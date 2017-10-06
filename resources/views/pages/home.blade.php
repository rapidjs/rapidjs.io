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
            <h1 class="home__hero__title">An ORM-like Interface For Your Frontend Requests</h1>
            <h2 class="home__hero__subtitle">Create simple, resusable, and cleaner wrappers and interfaces for your API requests.</h2>

            <a href="{{ route('docs') }}" class="rapid-btn">Get Started</a>

            <span class="bottom-arrow"><i class="fa fa-chevron-down"></i></span>
        </div>
    </div>

    <div class="home__callout">
        <div class="home__callout__inner wrapper">
            <div class="container fb-grid row home__callout__inner">
                <div class="home__callout__logo home__callout__logo--with-text">
                    <span>View the project on</span>

                    <a target="_blank" href="{{ config('app')['github'] }}">
                        <img src="/images/github-logo.png" alt="Github">
                    </a>
                </div>
            </div>

            {{-- <div class="container fb-grid row home__callout__logos">
                @foreach (config('logos') as $logo)
                    <div class="home__callout__logo">
                        <a target="_blank" href="{{ $logo['url'] }}">
                            <img src="/images/{{ $logo['logo'] }}" alt="{{ $logo['name'] }}">
                        </a>
                    </div>
                @endforeach
            </div> --}}
        </div>
        {{-- <span class="home__callout__trusted">These sites use and trust rapid as their API interface.</span> --}}

    </div>

    <div class="home__inner">
        {{-- @include('components.svg-grid') --}}

        <div class="home wrapper">

            <div class="container fb-grid row home__side-by-side">
                <div class="fb-grid col-xs-12 col-md-7  home__side-by-side__section">
                    <h3>Define Simple Models</h3>
                    <div class="home__side-by-side__inner dark-block">
                        <pre>
                            <code class="language-js">
                                var post = new Rapid({ modelName: 'Post' });

                                post.find(1).then((response) => {
                                    // GET => /api/post/1
                                });

                                post.collection.findBy('category', 'featured').then((response) => {
                                    // GET => /api/posts/category/featured
                                });

                                post.withParams({ limit: 20, order: 'desc' }).all().then((response) => {
                                    // GET => /api/posts?limit=20&order=desc
                                });

                                post.update(25, { title: 'Rapid JS Is Awesome!' })
                                    // POST => /api/posts/25/update

                                post.destroy(9)
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
                                var post = new Rapid({
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

                                post.update(25, { title: 'Rapid JS Is Awesome!' })
                                    // POST => /api/posts/25/save/

                                post.destroy(9)
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

                <span class="home__callout__action">
                    <a href="{{ route('docs') }}" class="rapid-btn rapid-btn--med">Read the Docs</a>
                </span>

            </div>
        </div>
    </div>

    <div class="home__inner">
        {{-- @include('components.svg-grid') --}}

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

                                var photo = new Base({ modelName: 'Photo' });
                                var gallery = new Base({ modelName: 'Gallery' });
                                var tag = new Base({ modelName: 'Tag' });

                                photo.find(1)
                                    // GET => https://myapp.com/api/photo/1?key=MY_API_KEY

                                tag.collection.findBy('color', 'red')
                                    // GET => https://myapp.com/api/tags/color/red?key=MY_API_KEY

                                gallery.id(23).get('tags', 'nature')
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

                                var gallery = new GalleryWrapper({
                                    globalParameters: { key: 'MY_API_KEY' }
                                });

                                gallery.tagSearch('nature').json().get().then(...);
                                    // GET https://myapp.com/gallery/api/tagsearch/json?query=nature&key=MY_API_KEY
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
