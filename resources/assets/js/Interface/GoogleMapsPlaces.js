import Rapid from './Rapid/Rapid';

// This will not actually work since Google requires you to use
// Places Library. This is just to show you what you can build
class GalleryWrapper extends Rapid {
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
    },
    debug: true
});
