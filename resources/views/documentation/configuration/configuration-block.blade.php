<div class="docs__configuration">

    @include('documentation.configuration.configuration', ['configuration' => data('configuration')[$configuration]])

    @if(View::exists('documentation.configuration.code.' . $configuration))
        <div class="docs__configuration__code">
            <b>Example:</b><br>

            @include('documentation.configuration.code.' . $configuration)
        </div>
    @endif

</div>
