<pre><code class="language-js">
class Gallery extends Rapid {
    boot () {
        this.modelName = 'Gallery';
    }

    slug (slug) {
        return this.url(slug, true);
    }

    json () {
        return this.url('json');
    }

    findBySlugOnly (name) {
        return this.url(name, false, true);
    }
}

var gallery = new Gallery();

gallery.slug('nature-album').json().get();
    // GET => /api/nature-album/json

gallery.json().slug('nature-album').get();
    // GET => /api/nature-album/json

gallery.json().slug('nature-album').findBySlugOnly('new-slug').get();
    // GET => /api/new-slug
</code></pre>

<p>Because <code class="language-js">slug()</code> has <code class="language-js">prepend</code> set to <code class="language-js">true</code>, the order does not matter. It will always be prepended to the url and both examples produce the same result. <code class="language-js">findBySlugOnly()</code> overwrites the entire url because <code class="language-js">overwrite</code> set to <code class="language-js">true</code>.</p>
