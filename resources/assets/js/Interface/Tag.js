import Rapid from './Rapid/Rapid';

class Tag extends Rapid {
    boot () {
        this.baseURL = 'apples2apples.com/api';
        this.modelName = 'Tag';
        this.config.globalParameters = { API_KEY: 123345 }
    }
}

export default Tag;
