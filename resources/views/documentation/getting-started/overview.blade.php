@component('components.notice')
    This is the first release of rapid and it is still in development. Please report any bugs to the <a target="_blank" href="{{ config('app')['github'] }}/issues">github page</a>.
@endcomponent

@include('components.heading', ['type' => 'h2', 'name' => 'overview', 'title' => 'What is rapid?'])

<p>rapid.js is a fluent framework for rapidly building API wrappers, reusable base models, and intertacting with APIs. Every project I built that required basic or extensive API requests seemed to repeat the same process: decide on a framework, download and configure it, and manually write my API calls time and time again. If I wanted to reuse any of those calls around different parts of the app, I'd have to continually extend or rewrite them. And if the routes changed I'd have to update them everywhere and it just became messy. I got tired of it. So, I wrote rapid.</p>

<p>rapid makes building API wrappers, reusable base models, and interacting with APIs super easy and well, rapid. There's almost no configuration required to get started but it's extremely configurable to fit any API.</p>
