@extends('layouts.master')

@section('content')

    <div class="container fb-grid row center-xs">

         <div class="col-xs-12 col-md-6 contribute__support">
            <h1>Contribute to rapid.js</h1>

            <div class="contribute__github">
                Please report any issues on the <a target="_blank" href="{{ config('app')['github'] }}/issues">github page</a><br>
                If you'd like to contribute feel free to <a target="_blank" href="{{ config('app')['github'] }}">fork the repo</a><br><br>

                <p class="contribute__subnote">Rapid is a side-project that I developed for fun to make my development easier. This is my first larger package I've released and so I'm thankful for any advice, suggestions, contributions, and support given! Please feel free to leave any and all feedback on the <a target="_blank" href="{{ config('app')['github'] }}/issues">github page</a>.</p>
            </div>
         </div>

    </div>

@endsection
