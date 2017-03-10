import Rapid from './Rapid/Rapid';

// This will not actually work since Google requires you to use
// Places Library. This is just to show you what you can build
class GoogleMapsPlace extends Rapid {

    boot () {
        this.baseURL = 'https://maps.googleapis.com/maps/api';
    }

    textSearch (query) {
        return this.setURLParams('textsearch', true, true).withParam('query', query);
    }

    radarSearch (query) {
        return this.setURLParams('radarsearch', true, true).withParam('query', query);
    }

    json () {
        return this.setURLParams('json');
    }

    xml () {
        return this.setURLParams('xml');
    }
}

export default new GoogleMapsPlace({
    modelName: 'place',
    globalParameters: {
      key: 'YOUR_API_KEY'
    },
    // debug: true
    onError (response) {
        alert ("Something went wrong!");
    }
});
