<div class="docs__method">

    @include('documentation.methods.method', ['method' => config('methods')[$method]])

    @if(View::exists('documentation.methods.code.' . $method))
        <div class="docs__method__code">
            @include('documentation.methods.code.' . $method)
        </div>
    @endif

</div>
