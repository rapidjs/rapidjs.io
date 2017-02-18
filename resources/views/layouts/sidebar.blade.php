<div class="sidebar fb-grid col-md-2">
    <div>
        
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

    </div>
</div>
