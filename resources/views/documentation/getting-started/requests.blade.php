@include('components.heading', ['type' => 'h2', 'name' => 'requests', 'title' => 'Requests'])

<p>In addition to the above methods, you can make basic <code class="language-js">get()</code>, <code class="language-js">post()</code>, <code class="language-js">put()</code>, <code class="language-js">patch()</code>, <code class="language-js">head()</code>, <code class="language-js">delete()</code> requests. Each method takes the same parameter(s).</p>

@component('components.code')
var gallery = new Rapid({ modelName: 'Gallery' });

gallery.get('tags').then(function (response) {
    // GET => /api/gallery/tags
})

gallery.id(45).get('photos/page/1').then(...)
    // GET => /api/gallery/45/photos/page/1

// the same result can be achieved by comma separating parameters
gallery.id(45).get('photos', 'page', 1).then(...)
    // GET => /api/gallery/45/photos/page/1

// GET request to the collection route
gallery.collection.get('recent')
    // GET => /api/galleries/recent

// using .post
gallery.id(34).post().then(...)
    // POST => /api/gallery/34
@endcomponent

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'get', 'text' => 'get()'],
    ['section' => 'method', 'key' => 'post', 'text' => 'post()'],
    ['section' => 'method', 'key' => 'put', 'text' => 'put()'],
    ['section' => 'method', 'key' => 'put', 'text' => 'patch()'],
    ['section' => 'method', 'key' => 'put', 'text' => 'head()'],
    ['section' => 'method', 'key' => 'put', 'text' => 'delete()']
]])
