@extends('layouts.master')

@section('content')

    <div class="container fb-grid row">

        @include('layouts.sidebar')

        <div class="docs fb-grid col-xs-12 col-md-9 col-md-offset-2">

            @foreach(config('docs')['pages'] as $page)
                @if(View::exists('documentation.' . $page))
                    @include('documentation.'. $page)
                @endif
            @endforeach

            @include('layouts.footer')

        </div>

    </div>

@endsection
