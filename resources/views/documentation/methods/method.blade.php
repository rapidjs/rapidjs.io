@include('components.heading', [
    'type'  => 'h3',
    'name'  => 'method-' . $method['name'],
    'title' => $method['name'] . '(' . implode(', ', array_map(function($arg) { return '<b>' . $arg['name'] . '</b>'; }, $method['arguments'])) . ')'
])

<div class="docs__method__description">
    {!! $method['description'] !!}
</div>

@if(!empty($method['arguments']))
    <div class="docs__method__section method__section--arguments">
        <b>Arguments:</b>

        <div class="docs__method__arguments">
            @foreach ($method['arguments'] as $arg)
                <p class="docs__method__argument">
                    <code class="language-js">{{ $arg['name'] }}</code>
                    <em>{{ '&#123;' . $arg['type'] . '&#125;' }}</em>
                    @if($arg['description'])<span> - {!! $arg['description'] !!}</span>@endif
                    @if(isset($arg['default'])) | <b>Default:</b> <em>{!! $arg['default'] !!}</em>@endif
                </p>
            @endforeach
        </div>
    </div>
@endif

{{-- <div class="docs__method__section docs__method__section--since">
    <b>Since:</b>

    <p>
        <span>{{ $method['since'] }}</span>
    </p>
</div> --}}

<div class="docs__method__section docs__method__section--arguments">
    <b>Returns:</b>

    <span>{{ $method['returns'] }}</span>
</div>
