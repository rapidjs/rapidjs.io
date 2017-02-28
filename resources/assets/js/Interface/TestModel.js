import Rapid from './Rapid/Rapid';
import UserModel from './UserModel';
import Tag from './Tag';

// http://www.stylemepretty.com/api/v2/post/770865/images


class TestModel extends Rapid {
    boot () {
        this.methodRoutes = ['posts', 'media', 'recentMedia', 'votes'];
    }

    posts (id, params) {
        return this.collection.belongsTo('posts', id, params);
    }

    media (id, params) {
        // return this.collection.hasRelationship(id, ['media', 'recent'], params);
        // return this.model.hasRelationship(id, ['media', 'recent'], params).get();
    }

    recentMedia (id, params) {
        // return this.media(id, params).append('recent');
    }

    votes (id, params) {
        // return this.model.hasRelationship(id, 'votes', params);
    }

    user () {
        return this.hasOne(UserModel, 235, 19);
    }

    users () {
        return this.hasMany(UserModel, 999, 'verified');
    }

    tags () {
        return this.hasMany('tags', 1234);
    }
}

export default new TestModel({
    modelName: 'Photo',
    debug: true,
    globalParameters: {

    }
});
