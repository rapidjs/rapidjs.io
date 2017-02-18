<h2 id="methods">Methods</h2>

@foreach (config('methods') as $method => $data)
    @include ('documentation.methods.method-block', ['method' => $method])
@endforeach
