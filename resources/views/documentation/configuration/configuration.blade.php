<h3 id="configuration-{{ $configuration['name'] }}">
    {{ $configuration['name'] }}
</h3>

<div class="docs__configuration__section docs__configuration__type">
    <b>Type:</b> <code class="language-js">{{ $configuration['type'] }}</code>
</div>

@if($configuration['description'])
    <div class="docs__configuration__section docs__configuration__description">
        {{ $configuration['description'] }}
    </div>
@endif

<div class="docs__configuration__section docs__configuration__default">
    <b>Default:</b>

    @if($configuration['multiline'])
        <p>
            <pre><code class="language-js">{{ trim($configuration['default']) }}</code></pre>
        </p>
    @else
        <code class="language-js">{{ $configuration['default'] }}</code>
    @endif


</div>

<div class="docs__configuration__section docs__configuration__section docs__configuration__section--since">
    <b>Since:</b>

    <p>
        <span>{{ $configuration['since'] }}</span>
    </p>
</div>
