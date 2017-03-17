<h2 id="methods">Methods</h2>

<ul class="docs__columns fb-grid col-xs-6 col-md-8">
    @foreach (config('methods') as $method => $data)
        <li><a href="#method-{{ $method }}">{{ $method }}</a></li>
    @endforeach
</ul>

@foreach (config('methods') as $method => $data)
    @include ('documentation.methods.method-block', ['method' => $method])
@endforeach
