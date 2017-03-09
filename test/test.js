import test from 'ava';
import Rapid from './../resources/assets/js/Interface/Rapid/Rapid';

var userModel = new Rapid({
    modelName: 'user',
    debug: true
});

userModel.debugger.logEnabled = false;

test('will have the right api url for find', t => {

    userModel.find(1);

    t.is('api/user/1', userModel.debugger.data.lastUrl);

});

test('will have the right api url for all', t => {

    userModel.all();

    t.is('api/users', userModel.debugger.data.lastUrl);

    userModel.withParams({ status: 'active' }).all();

    t.is('api/users?status=active', userModel.debugger.data.lastUrl);

});

var myModel = new Rapid({
    modelName: 'model',
    debug: true
});

myModel.debugger.logEnabled = false;

test('that it will have the right api url for findBy', t => {

    myModel.findBy('key', 'value');

    t.is('api/model/key/value', myModel.debugger.data.lastUrl);

    myModel.collection.findBy('key', 'value');

    t.is('api/models/key/value', myModel.debugger.data.lastUrl);


});

test('current route will reset', t => {

    myModel.collection.findBy('key', 'value');

    t.is('model', myModel.currentRoute);

});

test('hasRelationship produces proper URL', t => {

    myModel.hasRelationship('posts', 1);

    t.is('api/model/1/posts', myModel.debugger.data.lastUrl);

});

test('belongsTo produces proper URL', t => {

    let myModel = new Rapid({
        modelName: 'comment',
        debug: true
    });

    myModel.belongsTo('post', 1234, false);

    t.is('api/post/1234/comments', myModel.debugger.data.lastUrl);

    myModel.belongsTo('post', 1234, 'id');

    t.is('api/post/id/1234/comments', myModel.debugger.data.lastUrl);

    myModel.belongsTo('post', 1234, 'id', 'premium');

    t.is('api/post/id/1234/comments/premium', myModel.debugger.data.lastUrl);

    myModel.belongsTo('post', 1234, 'id', ['premium', 'latest', 'desc']);

    t.is('api/post/id/1234/comments/premium/latest/desc', myModel.debugger.data.lastUrl);

});

// test('belongsTo on collection with foreignKeyName produces proper URL', t => {
//
//     let myModel = new Rapid({
//         modelName: 'comments',
//         debug: true
//     });
//
//     myModel.collection.belongsTo('post', 1234, '', 'id');
//
//     t.is('api/posts/id/1234/comments', myModel.debugger.data.lastUrl);
//
// });


let postModel = new Rapid({
    modelName: 'post',
    debug: true
});

postModel.debugger.logEnabled = false;

test('that withParams works', t => {

    postModel.collection.withParams({ limit: 20 }).findBy('category', 'featured');

    t.is('api/posts/category/featured?limit=20', postModel.debugger.data.lastUrl);

});

test('that withParam works', t => {

    postModel.withParam('status', 'published').get();

    t.is('api/post?status=published', postModel.debugger.data.lastUrl);

    postModel.collection.withParam('status', 'published').findBy('category', 'featured');

    t.is('api/posts/category/featured?status=published', postModel.debugger.data.lastUrl);

});

test('that with works', t => {

    postModel.collection.with({ params: { limit: 20, published: true, orderBy: 'commentCount', order: 'desc' } }).findBy('category', 'featured');

    t.is('api/posts/category/featured?limit=20&published=true&orderBy=commentCount&order=desc', postModel.debugger.data.lastUrl);

});
