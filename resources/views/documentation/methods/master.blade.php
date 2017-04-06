<div class="docs__group">
    @include('components.heading', ['type' => 'h1', 'name' => 'methods', 'title' => 'Methods'])

    <ul class="docs__columns fb-grid col-xs-6 col-md-8">
        @foreach (data('methods') as $method => $data)
            <li><a href="#method-{{ $method }}">{{ $method }}</a></li>
        @endforeach
    </ul>

    @foreach (data('methods') as $method => $data)
        @include ('documentation.methods.method-block', ['method' => $method])
    @endforeach
</div>
