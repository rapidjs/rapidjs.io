<h2 id="configuration">Configuration</h2>

@foreach (config('configuration') as $configuration => $data)
    @include ('documentation.configuration.configuration-block', ['configuration' => $configuration])
@endforeach
