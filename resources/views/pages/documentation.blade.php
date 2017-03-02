@extends('layouts.master')

@section('content')

    @include('layouts.sidebar')

    <div class="docs fb-grid col-xs-12 col-md-10">

        <div class="docs__section">
            @include('documentation.overview')
        </div>

        <div class="docs__section">
            @include('documentation.installation')
        </div>

        <div class="docs__section">
            @include('documentation.usage')
        </div>

        <div class="docs__section">
            @include('documentation.class-builder')
        </div>

        @foreach(['methods', 'configuration'] as $file)
            <div class="docs__section">
                @include('documentation.'.$file.'.master')
            </div>
        @endforeach

    </div>

@endsection
