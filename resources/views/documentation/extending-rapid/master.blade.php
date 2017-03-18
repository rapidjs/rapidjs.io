<h1 id="extending-rapid">Extending Rapid</h1>

@foreach(['auth-model'] as $file)
    <div class="docs__section">
        @include('documentation.extending-rapid.'.$file)
    </div>
@endforeach
