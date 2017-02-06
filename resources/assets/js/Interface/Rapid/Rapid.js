import axios from 'axios';
import _ from 'lodash';
import pluralize from 'pluralize';
import Debugger from './Debugger';
import Logger from './Logger';

class Rapid {
    constructor (config) {
        let defaults = {
            modelName: this.constructor.name,

            primaryKey: '',

            baseURL: 'api',

            trailingSlash: false,

            caseSensitive: false,

            routeDelimeter: '-',

            globalParameters: {
                /**
                 * Need an option for global GET and POST params...
                 * what if we want to do /users/drew/save?api_key=12345
                 */
            },

            suffixes: {
                create : 'create',
                update : 'update',
                delete : 'delete',
            },

            methods: {
                create : 'post',
                update : 'post',
                delete : 'post'
            },

            routes: {
                model      : '',
                collection : '',
                any        : ''
            },

            debug: false,

            apiConfig: {

            }
        };

        config = config || {};

        this.config = _.defaultsDeep(config, defaults);

        if(!this.config.routes.model) {
            this.setModelRoute();
        }

        if(!this.config.routes.collection) {
            this.setCollectionRoute();
        }

        this.api = axios.create(_.defaultsDeep({ baseURL: this.config.baseURL.replace(/\/$/, '') }, this.config.apiConfig));

        this.currentRoute = 'model';

        this.debugger = this.debug ? new Debugger(this) : false;

    }

    /**
     * URL functions
     */
    makeUrl (...params) {

        if(this.config.trailingSlash) {
            params.push('');
        }
        console.log(params);
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

    // alias
    save (...params) {
        return this.update(...params);
    }

    // delete (id = 0, data, options)
    delete (...params) {
        return this.updateOrDelete('delete', ...params);
    }

    create (data, options) {
        return this.request(this.config.methods.create, this.model.makeUrl(this.config.suffixes.create), data, options);
    }



    /**
     * Collection Only Functions
     */

    all (data, options) {
        return this.request('get', this.collection.makeUrl(), data, options);
    }

    /**
     * Collection and Model functions
     */

    findBy (key, value, data, options) {
        let urlParams = [key];

        if(value) {
            urlParams.push(value);
        }

        return this.request('get', this.makeUrl(...urlParams), data, options);
    }

    /**
     * Relationships
     */
    // primray key, foreign key, relation
    hasRelationship (relation, primaryKey, foreignKey, data, requestOptions) {
        let url = '';

        if(_.isArray(foreignKey)) {
            url = this.makeUrl(primaryKey, relation, ...foreignKey);
        } else {
            url = this.makeUrl(primaryKey, relation, foreignKey)
        }

        return this.request('get', url, data, requestOptions);
    }

    belongsTo (relation, key, data, keyValue, requestOptions) {
        let route     = this.currentRoute,
            urlParams = [relation];

        if(keyValue) {
            urlParams.push(keyValue);
        }

        urlParams.push(key);
        urlParams.push(this.routes[route]);

        return this.request('get', this.any.makeUrl(...urlParams), data, requestOptions);
    }

    /**
     * The Request
     */

    parseRequestParams (type, data, options) {
        let params = [];

        if(['put', 'post', 'patch'].includes(type)) {
            data = _.defaultsDeep(data, this.config.globalParameters);
            params.push(data);
            params.push(options);

        } else {
            options.params = _.defaultsDeep(data, this.config.globalParameters);
            params.push(options);
        }

        return params;
    }

    request (type, url, data = {}, options = {}) {

        if(this.debug) {
            return this.debugger.fakeRequest(type, url, data, options);
        }

        return new Promise((resolve, reject) => {
            this.api[type].call(this, this.sanitizeUrl(url), ...this.parseRequestParams(type, data, options))
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
     * to build a request url
     */
    buildRequest (type, urlParams, data, options) {
        let url = _.isArray(urlParams) ? this.makeUrl(...urlParams) : this.makeUrl(urlParams);

        return this.request(type, url, data, options);
    }

    get (...params) {
        return this.buildRequest('get', ...params);
    }

    post (...params) {
        return this.buildRequest('post', ...params);
    }

    put (...params) {
        return this.buildRequest('put', ...params);
    }

    patch (...params) {
        return this.buildRequest('patch', ...params);
    }

    head (...params) {
        return this.buildRequest('head', ...params);
    }

    post (...params) {
        return this.buildRequest('post', ...params);
    }

    // fix this
    // delete (url, params) {
    //     return this.request('delete', url, params);
    // }


    /**
     * Setters and Getters
     */

    get debug () {
        return this.config.debug;
    }

    set debug (val) {
        Logger.warn('debug mode must explcitly be turned on via the constructor in config.debug');
    }

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


    get primaryKey () {
        return this.config.primaryKey;
    }

    set primaryKey (val) {
        this.config.primaryKey = val;
    }


    get modelName () {
        return this.config.modelName;
    }

    set modelName (val) {
        this.config.modelName = val;
        this.setModelRoute();
        this.setCollectionRoute();
    }


    get routeDelimeter () {
        return this.config.routeDelimeter;
    }

    set routeDelimeter (val) {
        this.config.routeDelimeter = val;
        this.setModelRoute();
        this.setCollectionRoute();
    }


    get caseSensitive () {
        return this.config.caseSensitive;
    }

    set caseSensitive (val) {
        this.config.caseSensitive = val;
        this.setModelRoute();
        this.setCollectionRoute();
    }

    // functions to build a collection route for relationships
    setModelRoute () {
        let route = _.kebabCase(this.config.modelName).replace(/-/g, this.config.routeDelimeter);

        if(this.config.caseSensitive) {
            route = this.config.modelName;
        }

        this.config.routes.model = route;
    }

    setCollectionRoute () {
        let route = _.kebabCase(pluralize(this.config.modelName)).replace(/-/g, this.config.routeDelimeter);

        if(this.config.caseSensitive) {
            route = pluralize(this.config.modelName);
        }

        this.config.routes.collection = route;
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

export default Rapid;
