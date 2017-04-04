@include('components.heading', ['type' => 'h2', 'name' => 'extending-making-a-wrapper', 'title' => 'Making an API Wrapper'])

<p>Rapid allows for you to create a wrapper for your endpoints, rapidly. When extending rapid, you can override any of the config in the <code class="language-js">boot()</code> method. Take the example endpoints below: </p>

<ul>
    <li><code class="language-js">https://mysite.com/api/gallery/tagsearch/{xml|json}</code></li>
    <li><code class="language-js">https://mysite.com/api/gallery/categorysearch/{xml|json}</code></li>
    <li><code class="language-js">https://mysite.com/api/gallery/{id}/{xml|json}</code></li>
    <li><code class="language-js">https://mysite.com/api/gallery/{id}/{tags|categories}/{xml|json}</code></li>
</ul>

<p>The class below demonstrates just how effortlessly you can write a wrapper for the above endpoints.</p>

<pre><code class="language-js">import rapid from 'rapid.js';

class GalleryWrapper extends rapid {
    boot () {
        this.baseURL = 'https://mysite.com/api';
        this.modelName = 'Gallery';
    }

    tagSearch (query) {
        return this.append('tagsearch').withParam('query', query);
    }

    categorySearch (query) {
        return this.append('categorysearch').withParam('query', query);
    }

    taxonomy (taxonomy) {
        return this.append(taxonomy);
    }

    json () {
        return this.append('json');
    }

    xml () {
        return this.append('xml');
    }
}

export default new GalleryWrapper({
    globalParameters: {
      key: 'YOUR_API_KEY'
    }
});
</code></pre>

<p>Now you can easily interact with the API like this:</p>

<pre><code class="language-js">import GalleryWrapper from './wrappers/GalleryWrapper';

GalleryWrapper.tagSearch('orange').json().get().then(...);
    // GET => https://mysite.com/api/gallery/tagsearch/json?query=orange&key=YOUR_API_KEY

GalleryWrapper.categorySearch('nature').xml().get().then(...);
    // GET => https://mysite.com/api/gallery/categorysearch/xml?query=nature&key=YOUR_API_KEY

GalleryWrapper.id(45).taxonomy('tags').json().get().then(...);
    // GET => https://mysite.com/api/gallery/45/tags/json?key=YOUR_API_KEY

GalleryWrapper.id(45).taxonomy('categories').xml().get().then(...);
    // GET => https://mysite.com/api/gallery/45/categories/xml?key=YOUR_API_KEY
</code></pre>

<p>In theory, this would work to build a wrapper around any public API as well.</p>

@include('components.see-also', ['routes' => [
    ['section' => 'method', 'key' => 'url', 'text' => 'url()'],
    ['section' => 'method', 'key' => 'prepend', 'text' => 'prepend()'],
    ['section' => 'method', 'key' => 'append', 'text' => 'append()']
]])
