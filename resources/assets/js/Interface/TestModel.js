import Rapid from './Rapid/Rapid';
import UserModel from './UserModel';
import Tag from './Tag';

class TestModel extends Rapid {
    boot () {

        this.addRelationship('hasOne', UserModel);
        this.addRelationship('hasMany', UserModel);
        this.addRelationship('hasOne', 'gallery');

        this.addRelationship('belongsTo', 'post');
        this.addRelationship('belongsToMany', Tag);
        this.addRelationship('belongsTo', Tag);

    }
}

export default new TestModel({
    modelName: 'Photo',
    debug: true,
    globalParameters: {

    }
});
