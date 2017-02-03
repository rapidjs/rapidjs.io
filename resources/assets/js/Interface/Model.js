import axios from 'axios';
import _ from 'lodash';
import pluralize from 'pluralize';

class Model {
    constructor (config) {
        let defaults = {
            modelName: this.constructor.name,

            primaryKey: 'id',

            baseURL: 'api',

            trailingSlash: false,

            keepCase: false,

            routeDelimeter: '-',

            globalParameters: {

            },

            suffixes: {
                create : 'create',
                update : 'update',
                delete : 'delete',
            },

            methods: {
                update : 'post',
                create : 'post',
                delete : 'post'
            },

            routes: {
                model      : '',
                collection : '',
                any        : ''
            },

            debug: false
        };


        config = config || {};

        this.config = _.defaultsDeep(config, defaults);

        if(!this.config.routes.model) {
            this.setModelRoute();
        }

        if(!this.config.routes.collection) {
            this.setCollectionRoute();
        }

        this.api = axios.create({
            baseURL: this.config.baseURL.replace(/\/$/, '')
        });

        this.data = {};
        this.currentRoute = 'model';

    }

    /**
     * URL functions
     */
    makeUrl (...params) {

        if(this.config.trailingSlash) {
            params.push('');
        }

        let url = this.sanitizeUrl([this.config.routes[this.currentRoute]].concat(params).join('/'));

        // reset currentRoute
        this.currentRoute = 'model';

        return url;
    }

    sanitizeUrl (url) {
        return url.replace(/([^:]\/)\/+/g, '$1');
    }

    /**
     * Model Only Functions
     */

    find (id) {
        return this.model.findBy(this.config.primaryKey, id);
    }

    updateOrDelete(method, ...params) {
        let urlParams = [],
            id        = params[0],
            data      = params[1],
            options   = params[2];

        if(Number.isInteger(id)) {
            if(this.primaryKey) {
                urlParams.push(this.primaryKey);
            }
            urlParams.push(id);
        } else {
            data    = params[0];
            options = params[1];
        }

        if(this.config.suffixes[method]) {
            urlParams.push(this.config.suffixes[method]);
        }

        return this.request(this.config.methods[method], this.model.makeUrl.call(this, ...urlParams), data, options);
    }

    // update (id = 0, data, options) {
    update (...params) {
        return this.updateOrDelete('update', ...params);
    }

    // delete (id = 0, data, options)
    delete (...params) {
        return this.updateOrDelete('delete', ...params);
    }



    /**
     * Collection Only Functions
     */

    all (data, options) {
        return this.get(this.collection.makeUrl(), data, options);
    }

    /**
     * Collection and Model functions
     */

    findBy (key, value, data, options) {
        let urlParams = [key];

        if(value) {
            urlParams.push(value);
        }

        return this.get(this.makeUrl(...urlParams), data, options);
    }

    /**
     * Relationships
     */

    hasRelationship (key, relation, data, requestOptions) {
        let url = this.makeUrl(key, relation);

        if(_.isArray(relation)) {
            url = this.makeUrl(key, ...relation);
        }

        return this.get(url, data, requestOptions);
    }

    belongsTo (relation, key, data, keyValue, requestOptions) {
        let route     = this.currentRoute,
            urlParams = [relation];

        if(keyValue) {
            urlParams.push(keyValue);
        }

        urlParams.push(key);
        urlParams.push(this.routes[route]);

        return this.get(this.any.makeUrl(...urlParams), data, requestOptions);
    }

    /**
     * The Request
     */
    request (type, url, data = {}, options = {}) {
        let params = [];

        if(['put', 'post', 'patch'].includes(type)) {
            data = _.defaultsDeep(data, this.config.globalParameters);
            params.push(data);
            params.push(options);
        } else {
            options.params = _.defaultsDeep(data, this.config.globalParameters);
            params.push(options);
        }

        if(this.debug) {
            // console.log(params);
            // console.log(options);
            return this.sanitizeUrl([this.baseURL, url].join('/'));
        }

        return new Promise((resolve, reject) => {
            this.api[type].call(this, this.sanitizeUrl(url), ...params)
                 .then(response => {
                    /**
                     * return entire response
                     */
                    resolve(response.data);
                 })
                 .catch(error => {
                    reject(error.response.data);
                 });
        });
    }

    /**
     * Setters and Getters
     */

    get collection () {
        this.currentRoute = 'collection';
        return this;
    }

    get model () {
        this.currentRoute = 'model';
        return this;
    }

    get any () {
        this.currentRoute = 'any';
        return this;
    }

    get routes () {
        return this.config.routes;
    }

    get baseURL () {
        return this.config.baseURL;
    }

    set baseURL (url) {
        this.config.baseURL = this.sanitizeUrl(url);
    }

    set primaryKey (val) {
        this.config.primaryKey = val;
    }

    get primaryKey () {
        return this.config.primaryKey;
    }

    set modelName (val) {
        this.config.modelName = val;
        this.setModelRoute();
        this.setCollectionRoute();
    }

    get modelName () {
        return this.config.modelName;
    }

    get routeDelimeter () {
        return this.config.routeDelimeter;
    }

    set routeDelimeter (val) {
        this.config.routeDelimeter = val;
        this.setModelRoute();
        this.setCollectionRoute();
    }

    set keepCase (val) {
        this.config.keepCase = val;
        this.setModelRoute();
        this.setCollectionRoute();
    }

    get keepCase () {
        return this.config.keepCase;
    }

    get debug () {
        return this.config.debug;
    }

    set modelRoute (val) {
        this.routes.model = val;
    }

    // functions to build a collection route for relationships
    setModelRoute () {
        let route = _.kebabCase(this.config.modelName).replace(/-/g, this.config.routeDelimeter);

        if(this.config.keepCase) {
            route = this.config.modelName;
        }

        this.config.routes.model = route;
    }

    setCollectionRoute () {
        let route = _.kebabCase(pluralize(this.config.modelName)).replace(/-/g, this.config.routeDelimeter);

        if(this.config.keepCase) {
            route = pluralize(this.config.modelName);
        }

        this.config.routes.collection = route;
    }

    setData(data) {
        this.data = data;
    }




    get (url, data, options) {
        return this.request('get', url, data, options);
    }

    post (url, data, options) {
        return this.request('post', url, data, options);
    }


    // // fix this
    // // delete (url, params) {
    // //     return this.request('delete', url, params);
    // // }
    //
    // head (url, params) {
    //     return this.request('head', url, params);
    // }
    //
    // put (url, params) {
    //     return this.request('put', url, params);
    // }
    //
    // patch (url, params) {
    //     return this.request('patch', url, params);
    // }
}

export default Model;
