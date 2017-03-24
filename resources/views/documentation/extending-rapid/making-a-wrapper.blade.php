@include('components.heading', ['type' => 'h2', 'name' => 'extending-making-a-wrapper', 'title' => 'Making an API Wrapper'])

<p>This example will not actually work since Google requires you to use Places Library but it shows just how easy you can extend rapid for any API interface.</p>

<pre><code class="language-js">import Rapid from './Rapid/Rapid';

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
