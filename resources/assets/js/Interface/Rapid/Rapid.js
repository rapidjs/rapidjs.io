import axios from 'axios';

import pluralize from 'pluralize';
import _defaultsDeep from 'lodash.defaultsdeep';
import _isArray from 'lodash.isarray';
import _kebabCase from 'lodash.kebabcase';

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
                destroy : 'destroy',
            },

            methods: {
                create : 'post',
                update : 'post',
                destroy : 'post'
            },

            routes: {
                model      : '',
                collection : '',
                any        : ''
            },

            defaultRoute: 'model',

            debug: false,

            apiConfig: {

            },
            // switch me to routes again?
            overrides: {
                routes: {
                    model: '',
                    collection: '',
                }
            }
        };

        config = config || {};

        // I think you need to move routes to here because if people want to override them it can cause a conflict since
        // routes are generated after the constructor and stored in the same object
        this.routes = {
            model      : '',
            collection : '',
            any        : ''
        };

        this.initialize(config, defaults);
    }

    initialize (config, defaults) {
        this.config = _defaultsDeep(config, defaults);

        this.fireSetters();

        this.api          = axios.create(_defaultsDeep({ baseURL: this.config.baseURL.replace(/\/$/, '') }, this.config.apiConfig));

        this.currentRoute = this.config.defaultRoute;

        this.setDebugger();

        this.resetRequestData();
    }

    fireSetters () {
        ['baseURL', 'modelName', 'routeDelimeter', 'caseSensitive'].forEach(setter => this[setter] = this.config[setter]);
    }

    setDebugger () {
        this.debugger = this.debug ? new Debugger(this) : false;
    }

    /**
     * URL functions
     */
    makeUrl (...params) {

        if(this.config.trailingSlash) {
            params.push('');
        }

        let url = this.sanitizeUrl([this.routes[this.currentRoute]].concat(params).join('/'));

        // reset currentRoute
        this.currentRoute = this.config.defaultRoute;

        return url;
    }

    sanitizeUrl (url) {
        url = url.replace(/([^:]\/)\/+/g, '$1').replace(/\?$/, '');

        if(!this.config.trailingSlash) {
            url = url.replace(/\/$/, '');
        }

        return url;
    }


    /**
     * Model Only Functions
     */

    find (id) {
        return this.model.findBy(this.config.primaryKey, id);
    }

    updateOrDestroy(method, ...params) {
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
        return this.updateOrDestroy('update', ...params);
    }

    // alias
    save (...params) {
        return this.update(...params);
    }

    // remove this to replace with destroy
    destroy (...params) {
        return this.updateOrDestroy('destroy', ...params);
    }

    create (data) {
        return this.withParams(data).request(this.config.methods.create, this.model.makeUrl(this.config.suffixes.create));
    }



    /**
     * Collection Only Functions
     */

    all () {
        return this.collection.get();
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


    hasRelationship (relation, primaryKey, foreignKey) {
        let urlParams = [];

        if(_isArray(foreignKey)) {
            urlParams = [primaryKey, relation, ...foreignKey];
        } else {
            urlParams = [primaryKey, relation, foreignKey];
        }

        return this.get(urlParams);
    }

    /**
     * belongsTo
     */
    belongsTo (relation, foreignKey, foreignKeyName, after) {
        let route     = this.currentRoute,
            urlParams = [relation];

        if(foreignKeyName) {
            urlParams.push(foreignKeyName);
        }

        urlParams.push(foreignKey);
        urlParams.push(this.routes[route]);

        if(_isArray(after)) {
            urlParams.push(...after);
        } else {
            urlParams.push(after);
        }

        return this.any.get(urlParams);
    }

    /**
     * The Request
     */

    parseRequestData (type) {
        let requestData = [],
            params        = this.requestData.params,
            options       = this.requestData.options;

        // axios handles the options differently for the request type
        if(['put', 'post', 'patch'].includes(type)) {
            params = _defaultsDeep(params, this.config.globalParameters);
            requestData.push(params);
            requestData.push(options);
        } else {
            options.params = _defaultsDeep(params, this.config.globalParameters);
            requestData.push(options);
        }

        return requestData;
    }

    request (type, url) {

        if(this.debug) {
            return this.debugger.fakeRequest(type, url);
        }

        return new Promise((resolve, reject) => {
            this.api[type].call(this, this.sanitizeUrl(url), ...this.parseRequestData(type))
                 .then(response => {
                    this.resetRequestData();

                    resolve(response);
                 })
                 .catch(error => {
                    this.resetRequestData();

                    reject(error.response);
                 });
        });
    }

    resetRequestData () {
        this.requestData = {
            params: {},
            options: {}
        };
    }

    /**
     * to build a request url
     */
    buildRequest (type, urlParams) {
        let url = _isArray(urlParams) ? this.makeUrl(...urlParams) : this.makeUrl(urlParams);

        return this.request(type, url);
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

    delete (...params) {
        return this.buildRequest('delete', ...params);
    }


    /**
     * params, options, and headers
     */

    with (data = {}) {
        this.requestData = _defaultsDeep(data, this.requestData);
        return this;
    }

    withParams (params = {}) {
        this.requestData.params = params;
        return this;
    }

    withParam (key, value) {
        this.requestData.params[key] = value;
        return this;
    }

    withOptions (options = {}) {
        this.requestData.options = options;
        return this;
    }

    withOption (key, value) {
        this.requestData.options[key] = value;
        return this;
    }

    withHeaders (header = {}) {

        return this;
    }

    withHeader (key, value) {

        return this;
    }

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
        this.setRoutes();
    }


    get routeDelimeter () {
        return this.config.routeDelimeter;
    }

    set routeDelimeter (val) {
        this.config.routeDelimeter = val;
        this.setRoutes();
    }


    get caseSensitive () {
        return this.config.caseSensitive;
    }

    set caseSensitive (val) {
        this.config.caseSensitive = val;
        this.setRoutes();
    }

    setRoute (route) {
        let newRoute = '',
            formattedRoute = {
                model      : this.config.modelName,
                collection : pluralize(this.config.modelName),
                any        : ''
            };

        if(this.config.routes[route] != '') {
            newRoute = this.config.routes[route];
        } else {
            newRoute = _kebabCase(formattedRoute[route]).replace(/-/g, this.config.routeDelimeter);

            if(this.config.caseSensitive) {
                newRoute = formattedRoute[route];
            }
        }

        this.routes[route] = newRoute;
    }

    setRoutes () {
        ['model', 'collection'].forEach(route => this.setRoute(route));
    }
}

export default Rapid;
