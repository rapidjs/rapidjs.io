@include('components.heading', ['type' => 'h2', 'name' => 'headers', 'title' => 'Headers'])

<p>Passing headers is also super easy by using the <code class="language-js">.withHeaders()</code> and <code class="language-js">.withHeader()</code>.</p>

<pre><code class="language-js">// pass multiple headers
post.withHeaders({'X-Requested-With': 'XMLHttpRequest'}).findBy(...)

// or just a single header
post.withHeader('X-Requested-With', 'XMLHttpRequest').update(...)
</pre></code>

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'withHeaders', 'text' => 'withHeaders()'],
    ['section' => 'method', 'key' => 'withHeader', 'text' => 'withHeader()']
]])
