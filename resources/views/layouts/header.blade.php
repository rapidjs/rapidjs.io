<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:locale" content="en_US" />
        <meta property="og:title" content="An ORM-like Interface For Your Frontend Requests." />
        <meta property="og:description" content="Create simple, resusable, and cleaner wrappers and interfaces for your API requests." />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:site_name" content="rapid js" />
        <meta property="og:image" content="http://rapidjs.io/images/fb/rapid.png" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="600" />

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" type="image/png" href="favicon.png" />

        @if (config('app')['env'] == 'production')
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-92986214-1', 'auto');
            ga('send', 'pageview');
        </script>

        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1126988884074080'); // Insert your pixel ID here.
            fbq('track', 'PageView');
        </script>

        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1126988884074080&ev=PageView&noscript=1"
        /></noscript>
        @endif

        <title>rapid js - An ORM-like Interface For Your Frontend Requests.</title>
    </head>
    <body class="{{ Route::currentRouteName() }}">

        @if (Route::currentRouteName() != 'home')
            <div class="header">
                <div class="header__inner">
                    @include('components.logo')

                    @if (Route::currentRouteName() == 'docs')
                        <div class="header__search">
                            <input id="docs-search" type="text" placeholder="Search...">
                        </div>
                    @endif

                    @if (Route::currentRouteName() != 'home')
                        <div class="header__nav">
                            @foreach (['docs' => 'Documentation', 'contribute' => 'Contribute'] as $route => $name)
                                <a class="{{ $route != Route::currentRouteName() ?: 'active' }}" href="{{ route($route) }}">{{ $name }}</a>
                            @endforeach
                        </div>
                    @endif
                    {{-- , 'support' => 'Support' --}}
                </div>
            </div>
        @endif

        <div class="wrapper" id="app">

{{-- @include ('layouts.nav') --}}
