/*!
  * Rapid.js v0.0.1
  * (c) 2017 Drew J Bartlett (http://drewjbartlett.com)
  * Released under the MIT License.
  */

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
     * Set the URL params
     */
    setURLParams (urlParams = [], prepend = false, overwrite = false) {
        this.urlParams = this.urlParams || [];

        if(overwrite) {
            this.urlParams = urlParams;

            return this;
        }

        if(prepend) {
            this.urlParams = urlParams.concat(this.urlParams);
        } else {
            this.urlParams = this.urlParams.concat(urlParams);
        }

        return this;
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
     * Set the current route.
     * This will set the current route to either model, collection, or any to make appropriate requests
     * Can also be changed by calling rapid.model.func() or rapid.collection.func()
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
     *
     * @param ...params Can be any length of params that will be joined by /
     */
    makeUrl (...params) {

        if(this.config.trailingSlash) {
            params.push('');
        }

        let url = this.sanitizeUrl([this.routes[this.currentRoute]].concat(params).join('/'));

        // reset currentRoute
        this.setCurrentRoute(this.config.defaultRoute);

        return url;
    }

    /**
     * This just makes sure there are no double slashes and no trailing
     * slash unless the config for it is set.
     *
     * @param url a url to sanitize
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
     * Prepends primaryKey if set
     *
     * @param id The model's id
     */
    find (id) {
        return this.model.findBy(this.config.primaryKey, id);
    }

    /**
     * Make a request to update or destroy a model
     *
     * @param method The method (update or destroy)
     * @param ...params Can be either (id, data) OR (data)
     */
    updateOrDestroy(method, ...params) {
        let urlParams = [],
            id        = params[0],
            data      = params[1];

        if(Number.isInteger(id)) {
            this.id(id);
            // if(this.config.primaryKey) {
            //     urlParams.push(this.config.primaryKey);
            // }
            // urlParams.push(id);
        } else {
            data    = params[0];
        }

        if(this.config.suffixes[method]) {
            urlParams.push(this.config.suffixes[method]);
        }

        if(method == 'update') {
            this.withParams(data);
        }

        // return this.model[this.config.methods[method]].call(this, ...urlParams);
        return this.model.buildRequest(this.config.methods[method], urlParams);
    }

    /**
     * See updateOrDestroy
     */
    update (...params) {
        return this.updateOrDestroy('update', ...params);
    }

    /**
     * Alias of update
     * See updateOrDestroy
     */
    save (...params) {
        return this.update(...params);
    }

    /**
     * See updateOrDestroy
     */
    destroy (...params) {
        return this.updateOrDestroy('destroy', ...params);
    }

    /**
     * Makes a request to create a new model based off the method and suffix for create
     *
     * @param data The data to be sent over for creation of model
     */
    create (data) {
        return this.withParams(data).buildRequest(this.config.methods.create, this.config.suffixes.create);
    }

    /**
     * This sets an id for a request
     * currently it doens't work with any of the CRUD methods.
     * It should work with this.
     *
     * @param id The id of the model
     */
    id (id) {
        let params = [];

        if(this.config.primaryKey) {
            params = [this.config.primaryKey, id];
        } else {
            params = [id];
        }

        // needs to prepend
        this.setURLParams(params, true);

        return this;
    }


    /**
     * Collection Only Functions
     */

    /**
     * Makes a GET request on a collection route
     */
    all () {
        return this.collection.get();
    }

    /**
     * Collection and Model functions
     */

    /**
     * Makes a GET request to find a model/collection by key, value
     *
     * @param key The key to search by
     * @param value The value to search by
     */
    findBy (key, value) {
        let urlParams = [key];

        if(value) {
            urlParams.push(value);
        }

        return this.get(...urlParams);
    }

    /**
     * Relationships
     */

    /**
     * Sets up a hasOne relationship
     * See hasRelationship
     */
    hasOne (relation, primaryKey, foreignKey) {
        return this.hasRelationship('hasOne', relation, primaryKey, foreignKey);
    }

    /**
     * Sets up a hasMany relationship
     * See hasRelationship
     */
    hasMany (relation, primaryKey, foreignKey) {
        return this.hasRelationship('hasMany', relation, primaryKey, foreignKey);
    }

    /**
     * Registers a relationship via the boot() method when extending a model
     *
     * @param type The type of relationship
     * @param relation The relation name OR object
     */
    registerHasRelation (type, relation) {
        let relationRoute = this.getRouteByRelationType(type, relation);

        this[relationRoute] = (
            (type, route) => {
                return (primaryKey, foreignKey) => { return this.hasRelationship(type, route, primaryKey, foreignKey); }
            }
        )(type, relationRoute);

        // add to methodRoutes for debugging
        this.methodRoutes.push(relationRoute);

        return this;
    }

    /**
     * Register a "has" Relationship
     *
     * @param type The type of 'has' Relationship (hasOne, hasMany)
     * @param relation The relation. A string or Rapid model
     * @param primaryKey The primaryKey of the relationship
     * @param foreignKey The foreignKey of the relationship
     */
    hasRelationship (type, relation = '', primaryKey = '', foreignKey = '') {
        let urlParams = [];

        relation = this.getRouteByRelationType(type, relation);

        /**
         * No longer do we need to make ...foreignKey an array because we can do .get() ??
         * does that make sense?
         */
        if(_isArray(foreignKey)) {
            urlParams = [primaryKey, relation, ...foreignKey];
        } else {
            urlParams = [primaryKey, relation, foreignKey];
        }

        this.setURLParams(urlParams, false, true);

        return this;
    }

    /**
     * Sets up a belongsTo relationship
     * See belongsToRelationship
     */
    belongsTo (relation, foreignKey, foreignKeyName, after) {
        return this.belongsToRelationship('belongsTo', relation, foreignKey, foreignKeyName, after);
    }

    /**
     * Sets up a belongsToMany relationship
     * See belongsToRelationship
     */
    belongsToMany (relation, foreignKey, foreignKeyName, after) {
        return this.belongsToRelationship('belongsToMany', relation, foreignKey, foreignKeyName, after);
    }

    /**
     * Registers a relationship via the boot() method when extending a model
     *
     * @param type The type of relationship
     * @param relation The relation name OR object
     */
    registerBelongsTo (type, relation) {

        let relationRoute = this.getRouteByRelationType(type, relation);

        this[relationRoute] = (
            (type, route) => {
                return (primaryKey, foreignKey, after) => { return this.belongsToRelationship(type, route, primaryKey, foreignKey, after); }
            }
        )(type, relationRoute);

        // add to methodRoutes for debugging
        this.methodRoutes.push(relationRoute);

        return this;
    }

    /**
     * Register a "belongsTo" Relationship
     *
     * @param type The type of 'has' Relationship (hasOne, hasMany)
     * @param relation The relation. A string or Rapid model
     * @param foreignKey The foreignKey of the relationship
     * @param foreignKeyName The foreignKeyName of the relationship
     * @param after Anything to append after the relationship
     */
    belongsToRelationship (type, relation, foreignKey, foreignKeyName, after) {
        relation = this.getRouteByRelationType(type, relation);

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

        this.setURLParams(urlParams, false, true);

        return this.any;
    }

    /**
     * Adds a relationship to the model when extending
     *
     * @param type The type of relationship ('hasOne', 'hasMany', 'belongsTo', 'belongsToMany')
     * @param relation The relationship either a Rapid model or string
     */
    addRelationship (type, relation) {
        let hasMethods     = ['hasOne', 'hasMany'],
            belongsMethods = ['belongsTo', 'belongsToMany'];

        if(hasMethods.includes(type)) {
            this.registerHasRelation(type, relation);
        } else if(belongsMethods.includes(type)) {
            this.registerBelongsTo(type, relation);
        }
    }

    /**
     * This gets the route of the relationship if a relationship
     * is passed rather than a string.
     */
    getRouteByRelationType (type, relation) {
        let relationRoute = relation,
            routes = {
                hasOne        : 'model',
                hasMany       : 'collection',
                belongsTo     : 'model',
                belongsToMany : 'collection'
            };

        if(typeof relation == 'object') {
            relationRoute = relation.routes[routes[type]];

            this.relationships[relationRoute] = relation;
        }

        return relationRoute;
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

        if(!this.isAllowedRequestType(type)) {
            return;
        }

        this.beforeRequest(type, url);

        if(this.config.debug) {
            return this.debugger.fakeRequest(type, url);
        }

        return new Promise((resolve, reject) => {
            this.api[type].call(this, this.sanitizeUrl(url), ...this.parseRequestData(type))
                 .then(response => {
                    this.afterRequest(response);

                    resolve(response);
                 })
                 .catch(error => {
                    this.onError(error.response);

                    reject(error.response);
                 });
        });
    }

    /**
     * Checks if is a valid request type
     *
     * @param type The request type
     */
    isAllowedRequestType (type) {
        if(!this.config.allowedRequestTypes.includes(type)) {
            Logger.warn(`'${type}' is not included in allowedRequestTypes: [${this.config.allowedRequestTypes.join(', ')}]`);

            return false;
        }

        return true;
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
        return this.buildRequest('get', params);
    }

    post (...params) {
        return this.buildRequest('post', params);
    }

    put (...params) {
        return this.buildRequest('put', params);
    }

    patch (...params) {
        return this.buildRequest('patch', params);
    }

    head (...params) {
        return this.buildRequest('head', params);
    }

    delete (...params) {
        return this.buildRequest('delete', params);
    }

    /**
     * Resets the request data
     */
    resetRequestData () {
        this.requestData = {
            params: {},
            options: {}
        };
    }

    /**
     * Before, after, and error
     */

    /**
     * This is fired before the request
     */
    beforeRequest (type, url) {
        return this.config.beforeRequest(type, url);
    }

    /**
     * This is fired after each request
     */
    afterRequest (response) {
        this.resetRequestData();
        this.config.afterRequest(response);
    }

    /**
     * This is fired on a request error
     */
    onError (error) {
        this.resetRequestData();
        this.config.onError(error);
    }


    /**
     * Params and Options
     */

    /**
     * Send data and options with the request
     *
     * @param data An object of params: {}, options: {}
     */
    with (data = {}) {
        this.requestData = _defaultsDeep(data, this.requestData);

        return this;
    }

    /**
     * Send params with the request
     *
     * @param params An object of params
     */
    withParams (params = {}) {
        this.requestData.params = params;

        return this;
    }

    /**
     * Send a single param with the request
     *
     * @param key The key name
     * @param value The value
     */
    withParam (key, value) {
        this.requestData.params[key] = value;

        return this;
    }

    /**
     * Send options with the request
     *
     * @param options An object of options
     */
    withOptions (options = {}) {
        this.requestData.options = options;

        return this;
    }

    /**
     * Send a single option with the request
     *
     * @param key The key name
     * @param value The value
     */
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

        return this;
    }

    get model () {
        this.setCurrentRoute('model');

        return this;
    }

    get any () {
        this.setCurrentRoute('any');

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

    /**
     * Set the routes for the URL based off model/collection and config
     *
     * @param route The key of the route to be set
     */
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

    /**
     * Loop through the routes and set them
     */
    setRoutes () {
        ['model', 'collection'].forEach(route => this.setRoute(route));
    }
}

export default Rapid;
