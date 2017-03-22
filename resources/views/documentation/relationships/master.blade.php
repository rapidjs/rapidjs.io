<div class="docs__group">
    @include('components.heading', ['type' => 'h1', 'name' => 'relationships', 'title' => 'Relationships'])

    @foreach(['basic-usage', 'extending'] as $file)
        <div class="docs__section">
            @include('documentation.relationships.'.$file)
        </div>
    @endforeach
</div>
