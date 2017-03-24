@extends('layouts.master')

@section('content')

    <div class="container fb-grid row">

        @include('layouts.sidebar')

        <div class="docs fb-grid col-xs-12 col-md-9 col-md-offset-2">

            @include('documentation.getting-started.master')

            {{-- @include('documentation.relationships.master') --}}

            @include('documentation.extending-rapid.master')

            @include('documentation.class-builder.app')

            @include('documentation.debugging.master')

            @foreach(['methods', 'configuration'] as $file)
                <div class="docs__section">
                    @include('documentation.'.$file.'.master')
                </div>
            @endforeach

            @include('layouts.footer')

        </div>

    </div>

@endsection
