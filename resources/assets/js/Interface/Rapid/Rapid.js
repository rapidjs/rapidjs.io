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

        this.initialize(config, Defaults);
    }

    /**
     * Set any config overrides in this method when extending
     */
    boot () {

    }

    initialize (config, defaults) {
        this.methodRoutes = []; // for debugging and registering routes

        this.boot();

        this.initializeRoutes();

        this.config = _defaultsDeep(config, defaults);

        this.fireSetters();

        this.initializeAPI();

        this.setCurrentRoute(this.config.defaultRoute);

        this.initializeDebugger();

        this.resetRequestData();
    }

    initializeRoutes () {
        this.routes = {
            model      : '',
            collection : '',
            any        : ''
        };
    }

    fireSetters () {
        ['baseURL', 'modelName', 'routeDelimeter', 'caseSensitive'].forEach(setter => this[setter] = this.config[setter]);
    }

    initializeDebugger () {
        this.debugger = this.debug ? new Debugger(this) : false;
    }

    initializeAPI () {
        this.api = axios.create(_defaultsDeep({ baseURL: this.config.baseURL.replace(/\/$/, '') }, this.config.apiConfig));
    }

    setCurrentRoute (route) {
        this.currentRoute = route;
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
        this.setCurrentRoute(this.config.defaultRoute);

        console.log('was reset');

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

        return this.request(this.config.methods[method], this.model.makeUrl.call(this, ...urlParams), data);
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

    // let this return this
    // this should set some url params or something...
    // or a url...idk
    // but this should be able to use any method like this.users().get() || this.users().posts()
    hasRelationship (relation, primaryKey, foreignKey) {
        let urlParams = [];

        if(_isArray(foreignKey)) {
            urlParams = [primaryKey, relation, ...foreignKey];
        } else {
            urlParams = [primaryKey, relation, foreignKey];
        }

        return this.get(urlParams);
    }

    // what if we want to define a relationship for posting to
    // consider this too

    hasOne (relation, primaryKey, foreignKey) {

        // take a class in and pass to hasRelationship with route
        if(typeof relation == 'object') {
            relation = relation.routes.model;
        }

        return this.hasRelationship(relation, primaryKey, foreignKey);
    }

    hasMany (relation, primaryKey, foreignKey) {
        // take a class in and pass to hasRelationship with route
        if(typeof relation == 'object') {
            relation = relation.routes.collection;
        }

        return this.hasRelationship(relation, primaryKey, foreignKey);
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

    beforeRequest (type, url) {
        return this.config.beforeRequest(type, url);
    }

    afterRequest (response) {
        this.config.afterRequest(response);
    }

    onError (error) {
        this.config.onError(error);
    }

    request (type, url) {

        if(this.debug) {
            return this.debugger.fakeRequest(type, url);
        }

        let beforeRequest = this.beforeRequest(type, url);

        return !beforeRequest ? beforeRequest : new Promise((resolve, reject) => {
            this.api[type].call(this, this.sanitizeUrl(url), ...this.parseRequestData(type))
                 .then(response => {
                    this.resetRequestData();
                    this.afterRequest(response);

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
