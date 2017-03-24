<div class="docs__group">
    @include('components.heading', ['type' => 'h1', 'name' => 'getting-started', 'title' => 'Getting Started'])

    @foreach(config('docs')['getting-started'] as $file)
        <div class="docs__section">
            @include('documentation.getting-started.'.$file)
        </div>
    @endforeach
</div>
