@include('components.heading', ['type' => 'h2', 'name' => 'extending-base-models', 'title' => 'Base Models'])

<p>Quite often, you may need want to have a base model that has common attributes such as a <code class="language-js">baseURL</code>. With rapid, base models are effortless. The example below would allow for the same <code class="language-js">baseURL</code> and <code class="language-js">API_KEY</code>.</p>

@component('components.code')
// Base.js
import Rapid from 'rapid.js';

class Base extends Rapid {
    boot () {
        this.baseURL = 'https://myapp.com/api';
        this.config.globalParameters = { key: 'MY_API_KEY' }
    }
}

export default Base;
@endcomponent

<p>And then just import your base model.</p>

@component('components.code')
import Base from './Base';

var photo   = new Base({ modelName: 'Photo' }););
var gallery = new Base({ modelName: 'Gallery' });
var tag     = new Base({ modelName: 'Tag' });

photo.find(1)
    // GET => https://myapp.com/api/photo/1?key=MY_API_KEY

tag.collection.findBy('color', 'red')
    // GET => https://myapp.com/api/tags/color/red?key=MY_API_KEY

gallery.id(23).get('tags', 'nature')
    // GET => https://myapp.com/api/gallery/23/tag/nature?key=MY_API_KEY
@endcomponent

<p>When using the <code class="language-js">boot()</code> method, you can override any of the normal config. However, when changing the <code class="language-js">baseURL</code>, <code class="language-js">modelName</code>, <code class="language-js">routeDelimeter</code>, or <code class="language-js">caseSensitive</code> variables, you must use the setters rather than referencing the config itself. This is because the routes need to be regenerated after those config variables are changed.</p>

@component('components.code')
class Base extends Rapid {
    boot () {
        this.baseURL        = 'https://myapp.com/api';
        this.modelName      = 'SomeModel';
        this.routeDelimeter = '-';
        this.caseSensitive  = true;

        // any other config can be referenced like this
        this.config.globalParameters = { key: 'MY_API_KEY' }
    }
}
@endcomponent
