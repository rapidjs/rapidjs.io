@include('components.heading', ['type' => 'h2', 'name' => 'routes', 'title' => 'Routes'])

<p>We generally write our APIs with the concept of a <code class="language-markdown">`model`</code> and a <code class="language-markdown">`collection`</code>. Take the example a Photo <code class="language-markdown">`model`</code>. You can make API requests to a single Photo <code class="language-markdown">/api/photo/1</code> but also maybe you want to request a <code class="language-markdown">`collection`</code> of Photos <code class="language-markdown">/api/photos/tag/nature</code>. Rapid is designed at its core to handle both of these scenarios by simply calling <code class="language-js">.model</code> or <code class="language-js">.collection</code> prior to a request.</p>

<pre><code class="language-js">
var Photo = new Rapid({ modelName: 'photo' });

// by default, the route will be model
Photo.findBy('tag', 'featured'); // GET => /api/photo/tag/featured

// call the collection route
Photo.collection.findBy('tag', 'featured'); // GET => /api/photos/tag/featured
</code></pre>

<p>Rapid also takes advantage of <a target="_blank" href="https://github.com/blakeembrey/pluralize">pluralize</a> and will automatically generate a collection route based off a camel case <code class="language-js">modelName</code></p>

<pre><code class="language-js">
var PhotoGallery = new Rapid({ modelName: 'PhotoGallery' });

PhotoGallery.findBy('tag', 'featured'); // GET => /api/photo-gallery/tag/featured

// call the collection route
PhotoGallery.collection.findBy('tag', 'featured'); // GET => /api/photo-galleries/tag/featured
</code></pre>

<p>You can change the <a href="#configuration-defaultRoute">defaultRoute</a> and <a href="#configuration-routes">override the pluralizing</a> as well as have complete customization of your routes through the <a href="#configuration">configuration</a>.</p>

@include('components.see-also', ['routes' => [
    ['section' => 'configuration', 'key' => 'defaultRoute', 'text' => 'defaultRoute'],
    ['section' => 'configuration', 'key' => 'routes', 'text' => 'routes']
]])
