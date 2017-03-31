@include('components.heading', ['type' => 'h2', 'name' => 'extending-making-a-wrapper', 'title' => 'Making an API Wrapper'])

<p>Rapid allows for you to create a wrapper for your endpoints, rapidly. When extending rapid, you can override any of the config in the <code class="language-js">boot()</code> method. Take the example below of the Google Maps API. This example below will not actually work since Google requires you to use their Places Library but it demonstrates just how easily you can build your own wrapper.</p>

<pre><code class="language-js">import Rapid from 'rapid';

class GoogleMapsPlace extends Rapid {
    boot () {
        this.baseURL = 'https://maps.googleapis.com/maps/api';
    }

    textSearch (query) {
        return this.url('textsearch', true, true).withParam('query', query);
    }

    radarSearch (query) {
        return this.url('radarsearch', true, true).withParam('query', query);
    }

    json () {
        return this.url('json');
    }

    xml () {
        return this.url('xml');
    }
}

export default new GoogleMapsPlace({
    modelName: 'place',
    globalParameters: {
      key: 'YOUR_API_KEY'
    }
});
</code></pre>

<p>Now you can easily interact with the API like this:</p>

<pre><code class="language-js">import GoogleMapsPlaces from './models/GoogleMapsPlaces';

GoogleMapsPlaces.textSearch('123 main street').json().get();
    // GET https://maps.googleapis.com/maps/api/place/textsearch/json?query=123%20main%20street&key=YOUR_API_KEY

GoogleMapsPlaces.radarSearch('123 main street').xml().get();
    // GET https://maps.googleapis.com/maps/api/place/radarsearch/xml?query=123%20main%20street&key=YOUR_API_KEY
</code></pre>
