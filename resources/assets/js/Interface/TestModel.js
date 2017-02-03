import Model from './Model';

class TestModel extends Model {
    posts (id, params) {
        return this.collection.belongsTo('posts', id, params);
    }

    media (id, params) {
        return this.model.hasRelationship(id, ['media', 'recent'], params);
        // return this.model.hasRelationship(id, ['media', 'recent'], params).get();
    }

    recentMedia (id, params) {
        // return this.media(id, params).append('recent');
    }

    votes (id, params) {
        return this.model.hasRelationship(id, 'votes', params);
    }
}

export default new TestModel({ baseURL: 'http://someapp.com/api', modelName: 'TestModel', debug: true });
