<div class="docs__group">
    @include('components.heading', ['type' => 'h1', 'name' => 'extending-rapid', 'title' => 'Extending Rapid'])

    @foreach(config('docs')['extending-rapid'] as $file => $name)
        <div class="docs__section">
            @include('documentation.extending-rapid.'.$file, ['name' => $name, 'anchor' => $file])
        </div>
    @endforeach
</div>
