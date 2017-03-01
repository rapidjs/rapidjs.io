import axios from 'axios';

import pluralize from 'pluralize';
import _defaultsDeep from 'lodash.defaultsdeep';
import _isArray from 'lodash.isarray';
import _kebabCase from 'lodash.kebabcase';

import Debugger from './Debugger';
import Logger from './Logger';
import Defaults from './Defaults';

class Rapid {

    constructor (config) {
        config = config || {};

        // merge defaults and config
        config = _defaultsDeep(config, Defaults);

        this.initialize(config);

    }

    /**
     * Set any config overrides in this method when extending
     */
    boot () {

    }

    /**
     * Setup the all of properties.
     */
    initialize (config) {
        this.methodRoutes  = []; // for debugging and registering routes
        this.relationships = {}; // any relationships that are now accessible

        this.boot();

        this.initializeRoutes();

        this.resetURLParams();

        this.config = config;

        this.fireSetters();

        this.initializeAPI();

        this.setCurrentRoute(this.config.defaultRoute);

        this.initializeDebugger();

        this.resetRequestData();
    }

    /**
     * Reset an URL params set from a relationship
     */
    resetURLParams () {
        this.urlParams = false;
    }

    /**
     * Initialize the routes.
     */
    initializeRoutes () {
        this.routes = {
            model      : '',
            collection : '',
            any        : ''
        };
    }

    /**
     * Fire the setters. This will make sure the routes are generated properly.
     * Consider if this is really even necessary
     */
    fireSetters () {
        ['baseURL', 'modelName', 'routeDelimeter', 'caseSensitive'].forEach(setter => this[setter] = this.config[setter]);
    }

    /**
     * Initialze the debugger if debug is set to true.
     */
    initializeDebugger () {
        this.debugger = this.config.debug ? new Debugger(this) : false;
    }

    /**
     * Initialize the API.
     */
    initializeAPI () {
        this.api = axios.create(_defaultsDeep({ baseURL: this.config.baseURL.replace(/\/$/, '') }, this.config.apiConfig));
    }

    /**
     * Set the current route
     */
    setCurrentRoute (route) {
        this.currentRoute = route;
    }

    /**
     * URL functions
     */

    /**
     * Based off the current route that's set this will take a set of params
     * and split it into a URL. This will then reset the route to the default
     * route after building the URL.
     */
    makeUrl (...params) {

        if(this.config.trailingSlash) {
            params.push('');
        }

        let url = this.sanitizeUrl([this.routes[this.currentRoute]].concat(params).join('/'));

        // reset currentRoute
        this.setCurrentRoute(this.config.defaultRoute);

        console.log('was reset');

        return url;
    }

    /**
     * This just makes sure there are no double slashes and no trailing
     * slash unless the config for it is set.
     */
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

    /**
     * Make a GET request to a url that would retrieve a single model.
     */
    find (id) {
        return this.model.findBy(this.config.primaryKey, id);
    }

    updateOrDestroy(method, ...params) {
        let urlParams = [],
            id        = params[0],
            data      = params[1];

        if(Number.isInteger(id)) {
            if(this.config.primaryKey) {
                urlParams.push(this.config.primaryKey);
            }
            urlParams.push(id);
        } else {
            data    = params[0];
        }

        if(this.config.suffixes[method]) {
            urlParams.push(this.config.suffixes[method]);
        }

        if(method == 'update') {
            this.withParams(data);
        }

        return this.request(this.config.methods[method], this.model.makeUrl.call(this, ...urlParams));
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
        return this.withParams(data).buildRequest(this.config.methods.create, this.config.suffixes.create);
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

    findBy (key, value) {
        let urlParams = [key];

        if(value) {
            urlParams.push(value);
        }

        return this.get(urlParams);
    }

    /**
     * Relationships
     */


    // what if we want to define a relationship for posting to
    // consider this too

    /**
     * Get these to work without having to pass into registerHasRelation
     *
     *
     *
     *
     *
     *
     *
     *
     *
     * 
     */
    hasOne (relation, primaryKey, foreignKey) {
        return this.registerHasRelation('hasOne', relation, primaryKey, foreignKey);
    }

    hasMany (relation, primaryKey, foreignKey) {
        return this.registerHasRelation('hasMany', relation, primaryKey, foreignKey);
    }

    registerBelongsTo (type, relation) {
        let urlParams = [],
            routes = {
                belongsTo: 'model',
                belongsToMany: 'collection'
            };
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

    belongsToMany () {

    }

    addRelationship (type, relation) {
        let hasMethods = ['hasOne', 'hasMany'];

        if(hasMethods.includes(type)) {
            this.registerHasRelation(type, relation);
        }
    }

    registerHasRelation (type, relation) {
        let relationRoute = relation,
            routes        = {
                hasOne: 'model',
                hasMany: 'collection'
            };

        /**
         * This sets the route of the relationship if a relationship
         * is passed rather than a string.
         */
        if(typeof relation == 'object') {
            relationRoute = relation.routes[routes[type]];

            this.relationships[relationRoute] = relation;
        }

        this[relationRoute] = (function (nm) { return function () { return this.hasRelationship(relationRoute); } })(relationRoute);

        // return this[relationRoute];
    }

    // allow for this.tags().get('green')
    hasRelationship (relation = '', primaryKey = '', foreignKey = '') {
        let urlParams = [];

        /**
         * No longer do we need to make ...foreignKey an array because we can do .get() ??
         * does that make sense?
         */
        if(_isArray(foreignKey)) {
            urlParams = [primaryKey, relation, ...foreignKey];
        } else {
            urlParams = [primaryKey, relation, foreignKey];
        }

        this.urlParams = urlParams;

        return this;
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
        type = type.toLowerCase();

        if(this.config.debug) {
            return this.debugger.fakeRequest(type, url);
        }

        let beforeRequest = this.beforeRequest(type, url);

        return !beforeRequest ? beforeRequest : new Promise((resolve, reject) => {
            this.api[type].call(this, this.sanitizeUrl(url), ...this.parseRequestData(type))
                 .then(response => {
                    this.resetRequestData();
                    this.afterRequest(response);

                    response.data = this.parseData(response.data);

                    resolve(response);
                 })
                 .catch(error => {
                    this.resetRequestData();
                    this.onError(error.response);

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
     * Config request methods
     */
    beforeRequest (type, url) {
        return this.config.beforeRequest(type, url);
    }

    afterRequest (response) {
        this.config.afterRequest(response);
    }

    onError (error) {
        this.config.onError(error);
    }

    parseData (data) {
        return this.config.parseData(data);
    }


    /**
     * to build a request url
     */
    buildRequest (type, urlParams) {

        if(this.urlParams) {
            urlParams = this.urlParams.concat(urlParams);
            this.resetURLParams();
        }

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

    /**
     * Setters and Getters
     */

    set debug (val) {
        Logger.warn('debug mode must explicitly be turned on via the constructor in config.debug');
    }

    get collection () {
        this.setCurrentRoute('collection');
        console.log('was triggered');

        return this;
    }

    get model () {
        this.setCurrentRoute('model');
        console.log('was triggered');


        return this;
    }

    get any () {
        this.setCurrentRoute('any');
        console.log('was triggered');


        return this;
    }

    set baseURL (url) {
        this.config.baseURL = this.sanitizeUrl(url);
        this.initializeAPI();
    }

    set modelName (val) {
        this.config.modelName = val;
        this.setRoutes();
    }

    set routeDelimeter (val) {
        this.config.routeDelimeter = val;
        this.setRoutes();
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

    // generateRoute (routeName)

    setRoutes () {
        ['model', 'collection'].forEach(route => this.setRoute(route));
    }
}

export default Rapid;
