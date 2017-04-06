<div class="docs__group">
    @include('components.heading', ['type' => 'h1', 'name' => 'debugging', 'title' => 'Debugging'])

    @foreach(data('docs')['debugging'] as $file => $name)
        @if(View::exists('documentation.extending-rapid.'.$file))
            <div class="docs__section">
                @include('documentation.extending-rapid.'.$file, ['name' => $name, 'anchor' => $file])
            </div>
        @endif
    @endforeach
</div>
