<?php

$configuration = [
    'baseURL' => [
        'name'        => 'baseURL',

        'type'        => 'string',

        'description' => 'The base url for your api.',

        'default'     => "'api'",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'modelName' => [
        'name'        => 'modelName',

        'type'        => 'string',

        'description' => 'The model name for the rapid model. This will determine the routes for both models and collections. The collection route will be generated as the plural version of this. For instance if you put <code class="language-markdown">`gallery`</code> the collection route would become <code class="language-markdown">`galleries`</code>. Using camel case will result in a delimited route as defined in <code class="language-markdown">`routeDelimeter`</code>',

        'default'     => "''",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'primaryKey' => [
        'name'        => 'primaryKey',

        'type'        => 'string',

        'description' => 'The primary key to be used in the url.',

        'default'     => "''",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'trailingSlash' => [
        'name'        => 'trailingSlash',

        'type'        => 'boolean',

        'description' => 'Whether or not to append a trailing slash to API urls. ',

        'default'     => "false",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'caseSensitive' => [
        'name'        => 'caseSensitive',

        'type'        => 'boolean',

        'description' => 'If for some reason you need to keep your urls case sensitive you can do so by setting this to <code class="language-js">true</code>.',

        'default'     => "false",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'routeDelimeter' => [
        'name'        => 'routeDelimeter',

        'type'        => 'string',

        'description' => 'The delimeter for route model/collection names.',

        'default'     => "-",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'globalParameters' => [
        'name'        => 'globalParameters',

        'type'        => 'object',

        'description' => 'Global parameters to be sent with every request such as an API_KEY.',

        'default'     => "{}",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'suffixes' => [
        'name'        => 'suffixes',

        'type'        => 'object',

        'description' => 'The suffixes for the <code class="language-js">create()</code>, <code class="language-js">update()</code>, and <code class="language-js">destroy()</code> methods. If you want to override any of them, you can here.',

        'default'     => "{
    create  : 'create',
    update  : 'update',
    destroy : 'destroy',
}",

        'multiline'   => true,

        'since'       => '0.0.1'
    ],

    'methods' => [
        'name'        => 'methods',

        'type'        => 'object',

        'description' => 'The request methods to be used for <code class="language-js">create()</code>, <code class="language-js">update()</code>, and <code class="language-js">destroy()</code>. If you want to override any of them, you can here.',

        'default'     => "{
    create  : 'post',
    update  : 'post',
    destroy : 'post'
}",

        'multiline'   => true,

        'since'       => '0.0.1'
    ],

    'routes' => [
        'name'        => 'routes',

        'type'        => 'object',

        'description' => 'By default, rapid will generate routes based off the <code class="language-js">modelName</code> config attribute. If you want to override one or the other, you can do so here.',

        'default'     => "{
    model      : '',
    collection : ''
}",

        'multiline'   => true,

        'since'       => '0.0.1'
    ],

    'defaultRoute' => [
        'name'        => 'defaultRoute',

        'type'        => 'string',

        'description' => 'There are two routes generated by default: <code class="language-markdown">`model`</code> and <code class="language-markdown">`collection`</code>. By default <code class="language-markdown">`model`</code> is set.',

        'default'     => "model",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'apiConfig' => [
        'name'        => 'apiConfig',

        'type'        => 'object',

        'description' => 'Rapid takes advantage of the awesome framework, <a target="_blank" href="https://github.com/mzabriskie/axios">axios</a>. This is any configuration that you\'d like to pass to <code class="language-markdown">`axios`</code>. ',

        'default'     => "{}",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'debug' => [
        'name'        => 'debug',

        'type'        => 'boolean',

        'description' => 'If set to true, this will enable the debugger and all requests will be logged in the console and not actually made. See <a href="#debugging">debugging</a> for more info.',

        'default'     => "false",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'beforeRequest' => [
        'name'        => 'beforeRequest',

        'type'        => 'function',

        'description' => 'A method to fire before each request is sent.',

        'default'     => "
beforeRequest (type, url) {

}
",

        'multiline'   => true,

        'since'       => '0.0.1'
    ],

    'afterRequest' => [
        'name'        => 'afterRequest',

        'type'        => 'function',

        'description' => 'A method that fires each time after a request is made. Note: this is an event that is fired after each request and <i>not</i> how you would retrieve the data from each individual request. ',

        'default'     => "
afterRequest (response) {

}
",

        'multiline'   => true,

        'since'       => '0.0.1'
    ],

    'onError' => [
        'name'        => 'onError',

        'type'        => 'function',

        'description' => 'The API request returns a promise. All errors thrown from the request\'s <code class="language-js">Promise.catch()</code> method will be passed into this method.',

        'default'     => "
onError (error) {

}
",

        'multiline'   => true,

        'since'       => '0.0.1'
    ],

    'allowedRequestTypes' => [
        'name'        => 'allowedRequestTypes',

        'type'        => 'array',

        'description' => 'If you only want to allow certain request types, you can do so here.',

        'default'     => "['get', 'post', 'put', 'patch', 'head', 'delete']",

        'multiline'   => false,

        'since'       => '0.0.1'
    ]



];


return collect($configuration)->map(function($config) {
    $config['prefix'] = 'configuration';

    return $config;
})->sortBy('name')->toArray();
