import axios from 'axios';
import _ from 'lodash';
import pluralize from 'pluralize';

class Model {
    constructor (config) {
        let defaults = {
            suffixes     : {
                create : 'create',
                update   : 'update',
                delete : 'delete',
            },

            methods      : {
                update   : 'post',
                create : 'post',
                delete : 'post'
            },

            baseURL      : 'api',

            trailingSlash: false,

            routeDelimeter: '-',

            routes: {
                model      : '',
                collection : '',
            },

            globalParameters: {

            },

            modelName: this.constructor.name,

            primaryKey: 'id'
        };

        config = config || {};

        this.config = _.assignIn(defaults, config);

        if(!this.config.routes.model) {
            this.config.routes.model = _.kebabCase(this.config.modelName).replace('-', this.config.routeDelimeter);
        }

        if(!this.config.routes.collection) {
            this.config.routes.collection = _.kebabCase(pluralize(this.config.modelName)).replace('-', this.config.routeDelimeter);
        }

        this.api = axios.create({
            baseURL: this.config.baseURL.replace(/\/$/, '')
        });
    }

    makeUrl (route, ...params) {

        if(this.config.trailingSlash) {
            params.push('');
        }

        return [this.config.routes[route]].concat(params).join('/');
    }

    find (id) {
        return this.findBy(this.config.primaryKey, id);
    }

    // adding params for findBy
    findBy (key, value, data, route = 'model', options) {
        let urlParams = [route, key];

        if(value) {
            urlParams.push(value);
        }

        return this.get(this.makeUrl(...urlParams), data, options);
    }

    findAllBy (key, value, data, options) {
        return this.findBy(key, value, data, 'collection', options);
    }

    all (data, options) {
        return this.get(this.makeUrl('collection'), data, options);
    }


    // update (id = 0, data, options) {
    update (...params) {
        return this.updateOrDelete('update', ...params);
    }

    // delete (id = 0, data, options)
    delete (...params) {
        return this.updateOrDelete('delete', ...params);
    }

    updateOrDelete(method, ...params) {
        let urlParams = ['model'],
            id        = params[0],
            data      = params[1],
            options   = params[2];

        if(Number.isInteger(id)) {
            urlParams.push('id');
            urlParams.push(id);
        } else {
            data    = params[0];
            options = params[1];
        }

        if(this.config.suffixes[method]) {
            urlParams.push(this.config.suffixes[method]);
        }

        return this.request(this.config.methods[method], this.makeUrl.call(this, ...urlParams), data, options);
    }

    create (data, options) {
        return this.request(this.config.methods.create, this.makeUrl('model', this.config.suffixes.create), data, options);
    }

    request (type, url, data = {}, options = {}) {
        let params = [];

        if(['put', 'post', 'patch'].includes(type)) {
            data = _.assignIn(data, this.config.globalParameters);
            params.push(data);
            params.push(options);
        } else {
            options.params = _.assignIn(data, this.config.globalParameters);
            params.push(options);
        }

        return new Promise((resolve, reject) => {
            this.api[type].call(this, this.sanitizeUrl(url), ...params)
                 .then(response => {
                    resolve(response.data);
                 })
                 .catch(error => {
                    reject(error.response.data);
                 });
        });
    }

    sanitizeUrl (url) {
        return url.replace(/([^:]\/)\/+/g, '$1');
    }






    get (url, data, options) {
        return this.request('get', url, data, options);
    }

    post (url, data, options) {
        return this.request('post', url, data, options);
    }


    // fix this
    // delete (url, params) {
    //     return this.request('delete', url, params);
    // }

    head (url, params) {
        return this.request('head', url, params);
    }

    put (url, params) {
        return this.request('put', url, params);
    }

    patch (url, params) {
        return this.request('patch', url, params);
    }
}

export default Model;
