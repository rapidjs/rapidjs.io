@foreach(['overview', 'installation', 'usage', 'parameters', 'routes', 'axios'] as $file)
    <div class="docs__section">
        @include('documentation.getting-started.'.$file)
    </div>
@endforeach
