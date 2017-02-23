export default {
    modelName: '',

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

    beforeRequest (type, url) {
        return true;
    },

    afterRequest (response) {

    },

    onError (response) {

    }
};
