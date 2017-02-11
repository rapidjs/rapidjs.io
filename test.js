import test from 'ava';
import Rapid from './resources/assets/js/Interface/Rapid/Rapid';

test('will have the right api url for find', t => {

    let myModel = new Rapid({
        modelName: 'user',
        debug: true
    });

    myModel.find(1);

    t.is('api/user/1', myModel.debugger.data.lastUrl);

});


test('will have the right api url for findBy', t => {

    let myModel = new Rapid({
        modelName: 'model',
        debug: true
    });

    myModel.findBy('key', 'value');

    t.is('api/model/key/value', myModel.debugger.data.lastUrl);

});

test('will have the right api url for findBy on Collection', t => {

    let myModel = new Rapid({
        modelName: 'model',
        debug: true
    });

    myModel.collection.findBy('key', 'value');

    t.is('api/models/key/value', myModel.debugger.data.lastUrl);

});

test('current route will reset', t => {

    let myModel = new Rapid({
        modelName: 'model',
        debug: true
    });

    myModel.collection.findBy('key', 'value');

    t.is('model', myModel.currentRoute);

});

test('hasRelationship produces proper URL', t => {

    let myModel = new Rapid({
        modelName: 'model',
        debug: true
    });

    myModel.hasRelationship('posts', 1);

    t.is('api/model/1/posts', myModel.debugger.data.lastUrl);

});

test('belongsTo produces proper URL', t => {

    let myModel = new Rapid({
        modelName: 'comments',
        debug: true
    });

    myModel.belongsTo('post', 1234, false);

    t.is('api/post/1234/comments', myModel.debugger.data.lastUrl);

});

test('belongsTo with foreignKeyName produces proper URL', t => {

    let myModel = new Rapid({
        modelName: 'comments',
        debug: true
    });

    myModel.belongsTo('post', 1234, '', 'id');

    t.is('api/post/id/1234/comments', myModel.debugger.data.lastUrl);

});

test('belongsTo on collection with foreignKeyName produces proper URL', t => {

    let myModel = new Rapid({
        modelName: 'comments',
        debug: true
    });

    myModel.collection.belongsTo('post', 1234, '', 'id');

    t.is('api/posts/id/1234/comments', myModel.debugger.data.lastUrl);

});
