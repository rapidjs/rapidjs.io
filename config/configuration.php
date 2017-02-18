<?php

return [
    'baseURL' => [
        'name'        => 'baseURL',

        'type'        => 'string',

        'description' => '',

        'default'     => "'api'",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'modelName' => [
        'name'        => 'modelName',

        'type'        => 'string',

        'description' => '',

        'default'     => 'this.constructor.name',

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'primaryKey' => [
        'name'        => 'primaryKey',

        'type'        => 'string',

        'description' => '',

        'default'     => "''",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'trailingSlash' => [
        'name'        => 'trailingSlash',

        'type'        => 'boolean',

        'description' => '',

        'default'     => "false",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'caseSensitive' => [
        'name'        => 'caseSensitive',

        'type'        => 'boolean',

        'description' => '',

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

        'description' => '',

        'default'     => "{}",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'suffixes' => [
        'name'        => 'suffixes',

        'type'        => 'object',

        'description' => '',

        'default'     => "
{
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

        'description' => '',

        'default'     => "
{
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

        'description' => '',

        'default'     => "
{
    model      : '',
    collection : '',
    any        : ''
}",

        'multiline'   => true,

        'since'       => '0.0.1'
    ],

    'defaultRoute' => [
        'name'        => 'defaultRoute',

        'type'        => 'string',

        'description' => '',

        'default'     => "model",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'overrides' => [
        'name'        => 'overrides',

        'type'        => 'object',

        'description' => '',

        'default'     => "routes: {}",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'apiConfig' => [
        'name'        => 'apiConfig',

        'type'        => 'object',

        'description' => '',

        'default'     => "{}",

        'multiline'   => false,

        'since'       => '0.0.1'
    ],

    'debug' => [
        'name'        => 'debug',

        'type'        => 'boolean',

        'description' => '',

        'default'     => "false",

        'multiline'   => false,

        'since'       => '0.0.1'
    ]

];
