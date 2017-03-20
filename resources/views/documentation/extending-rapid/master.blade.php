<div class="docs__group">
    <h1 id="extending-rapid">Extending Rapid</h1>

    @foreach(['auth-model', 'real-world'] as $file)
        <div class="docs__section">
            @include('documentation.extending-rapid.'.$file)
        </div>
    @endforeach
</div>
