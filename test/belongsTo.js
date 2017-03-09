import test from 'ava';
import Rapid from './../resources/assets/js/Interface/Rapid/Rapid';

test.todo('belongsTo with object');
test.todo('belongsTo with string');

// test('belongsTo produces proper URL', t => {
//
//     let myModel = new Rapid({
//         modelName: 'comment',
//         debug: true
//     });
//
//     myModel.debugger.logEnabled = false;
//
//     myModel.collection.belongsTo('post', 1234, false).get();
//
//     t.is('api/post/1234/comments', myModel.debugger.data.lastUrl);
//
//     myModel.belongsTo('post', 1234, 'id').get();
//
//     t.is('api/post/id/1234/comment', myModel.debugger.data.lastUrl);
//
//     myModel.belongsTo('post', 1234, 'id', 'premium').get();
//
//     t.is('api/post/id/1234/comment/premium', myModel.debugger.data.lastUrl);
//
//     myModel.belongsTo('post', 1234, 'id', ['premium', 'latest', 'desc']).get();
//
//     t.is('api/post/id/1234/comment/premium/latest/desc', myModel.debugger.data.lastUrl);
//
// });
