<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" type="image/png" href="favicon.png" />

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-92986214-1', 'auto');
          ga('send', 'pageview');
        </script>

        <title>rapid js - A Fluent Interface To Rapidly Interact With APIs.</title>
    </head>
    <body class="{{ Route::currentRouteName() }}">

        @if (Route::currentRouteName() != 'home')
            <div class="header">
                <div class="header__inner">
                    @include('components.logo')

                    {{-- @if (Route::currentRouteName() == 'docs')
                        <div class="header__search">
                            <input id="docs-search" type="text" placeholder="Search...">
                        </div>
                    @endif --}}

                    @if (Route::currentRouteName() != 'home')
                        <div class="header__nav">
                            @foreach (['docs' => 'Documentation', 'contribute' => 'Contribute', 'support' => 'Support'] as $route => $name)
                                <a class="{{ $route != Route::currentRouteName() ?: 'active' }}" href="{{ route($route) }}">{{ $name }}</a>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        @endif

        <div class="wrapper" id="app">

{{-- @include ('layouts.nav') --}}
