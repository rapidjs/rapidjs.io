<div class="sidebar fb-grid col-md-2">
    <div>
        <a class="sidebar__title" href="#installation">Getting Started</a>

        <ul class="sidebar__nav">
            @foreach(['installation', 'usage'] as $nav)
                <li><a href="#{{ $nav }}">{{ ucfirst($nav) }}</a></li>
            @endforeach
        </ul>


        <a class="sidebar__title" href="#config-builder">Config Builder</a>

        <ul class="sidebar__nav">
            @foreach(['core', 'overrides', 'suffixes', 'methods', 'options'] as $nav)
                <li><a href="#config-builder-{{ $nav }}">{{ ucfirst($nav) }}</a></li>
            @endforeach
        </ul>


        <a class="sidebar__title" href="#configuration">Configuration</a>

        <ul class="sidebar__nav">
            @foreach(config('configuration') as $configuration => $data)
                <li><a href="#configuration-{{ $configuration }}">{{ $configuration }}</a></li>
            @endforeach
        </ul>


        <a class="sidebar__title" href="#methods">Methods</a>

        <ul class="sidebar__nav">
            @foreach(config('methods') as $method => $data)
                <li><a href="#method-{{ $method }}">{{ $method }}</a></li>
            @endforeach
        </ul>

        <a class="sidebar__title" href="#debugging">Debugging</a>

        <a class="sidebar__title" href="#methods">Extending Rapid</a>

        <ul class="sidebar__nav">
            @foreach(['base-models' => 'Base Models'] as $nav => $name)
                <li><a href="#extending-{{ $nav }}">{{ $name }}</a></li>
            @endforeach
        </ul>


        <a class="sidebar__title" href="#request-tester">Request Tester</a>

    </div>
</div>
