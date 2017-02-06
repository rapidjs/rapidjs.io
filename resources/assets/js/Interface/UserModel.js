import Rapid from './Rapid/Rapid';

class UserModel extends Rapid {
    auth (id) {
        // return this.model.get(this.makeUrl('current'));
        // this.model.get(['current', id, 'meta'], data, options);
        return this.model.get(id);
    }

    saveOrder(id, order) {
        return this.model.post(['order', 'update'], order);
    }

    orderInfo(userId, orderId) {
        return this.collection.hasRelationship('order', userId, orderId);
        // return this.model.post(['order', 'update'], order);
    }

    posts (id, params) {
        return this.collection.hasRelationship(id, ['posts', 'comments'], params);
    }

    media (id, params) {
        return this.collection.belongsTo(id, 'media', params, 12);
    }

    votes (id, params) {
        return this.model.hasRelationship(id, 'votes', params);
    }
}

export default new UserModel({
    modelName: 'user',
    debug: true,
    globalParameters: {

    }
});
