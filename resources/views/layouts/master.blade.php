
@include('layouts.header')

    @yield('content')

@if (Route::currentRouteName() != 'docs')
    @include('layouts.footer')
@endif
