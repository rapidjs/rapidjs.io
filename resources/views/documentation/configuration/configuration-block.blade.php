<div class="docs__configuration">

    @include('documentation.configuration.configuration', ['configuration' => config('configuration')[$configuration]])

    @if(View::exists('documentation.configuration.code.' . $configuration))
        <div class="docs__configuration__code">
            @include('documentation.configuration.code.' . $configuration)
        </div>
    @endif

</div>
