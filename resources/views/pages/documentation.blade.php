@extends('layouts.master')

@section('content')

    <div class="container fb-grid row">

        @include('layouts.sidebar')

        <div class="docs fb-grid col-xs-12 col-md-10">

            @include('documentation.getting-started.master')

            @include('documentation.class-builder.app')

            @foreach(['methods', 'configuration'] as $file)
                <div class="docs__section">
                    @include('documentation.'.$file.'.master')
                </div>
            @endforeach

        </div>

    </div>

@endsection
