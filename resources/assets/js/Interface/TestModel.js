import Rapid from './Rapid/Rapid';

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
    baseURL: 'https://api.instagram.com/v1',
    modelName: 'user',
    debug: true,
    globalParameters: {
        access_token: '367549238.0a57b32.c15e943278e443a29f44ee4aaf6e0384'
    }
});
