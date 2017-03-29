import Rapid from './Rapid/Rapid';

class Gallery extends Rapid {
    construct () {
        this.modelName = 'Gallery';
    }

    slug (slug) {
        return this.url(slug, true);
    }

    json () {
        return this.url('json');
    }

    findBySlugOnly (name) {
        return this.url(name, false, true);
    }
}

export default new Gallery({ debug: true });
