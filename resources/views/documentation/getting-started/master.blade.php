<h1 id="getting-started">Getting Started</h1>

@foreach(['overview', 'installation', 'usage', 'additional-methods', 'parameters', 'routes', 'axios'] as $file)
    <div class="docs__section">
        @include('documentation.getting-started.'.$file)
    </div>
@endforeach
