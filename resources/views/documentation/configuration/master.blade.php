<div class="docs__group">
    <h1 id="configuration">Configuration</h1>

    <ul class="docs__columns fb-grid col-xs-6 col-md-8">
        @foreach (config('configuration') as $configuration => $data)
            <li><a href="#configuration-{{ $configuration }}">{{ $configuration }}</a></li>
        @endforeach
    </ul>

    @foreach (config('configuration') as $configuration => $data)
        @include ('documentation.configuration.configuration-block', ['configuration' => $configuration])
    @endforeach
</div>
