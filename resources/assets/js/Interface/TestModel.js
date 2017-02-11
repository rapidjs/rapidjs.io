import Rapid from './Rapid/Rapid';

// http://www.stylemepretty.com/api/v2/post/770865/images


class TestModel extends Rapid {
    posts (id, params) {
        return this.collection.belongsTo('posts', id, params);
    }

    media (id, params) {
        return this.collection.hasRelationship(id, ['media', 'recent'], params);
        // return this.model.hasRelationship(id, ['media', 'recent'], params).get();
    }

    recentMedia (id, params) {
        // return this.media(id, params).append('recent');
    }

    votes (id, params) {
        return this.model.hasRelationship(id, 'votes', params);
    }
}

export default new TestModel({
    // baseURL: 'https://my-api.com/v1',
    modelName: 'user',
    debug: true,
    globalParameters: {

    }
});
