<?php

$methods = [
    'find' => [
        'name'                => 'find',

        'description'         => 'Makes a GET Request on the model route for a given id.',

        'arguments'           => [
            [
                'name'        => 'id',
                'type'        => 'int',
                'description' => ''
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise',

        'routeSpecific'       => 'model'
    ],

    'findBy' => [
        'name'                => 'findBy',

        'description'         => 'Makes a GET Request on the model route for a key/value pair.',

        'arguments'           => [
            [
                'name'        => 'key',
                'type'        => 'string',
                'description' => 'The key to search by in the url. <code class="language-markdown">/api/post/`key`/value</code>'
            ],

            [
                'name'        => 'value',
                'type'        => 'string|int',
                'description' => 'The value to search by in the url. <code class="language-markdown">/api/post/key/`value`</code>'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise',

        'routeSpecific'       => ''
    ],

    'all' => [
        'name'                => 'all',

        'description'         => 'Makes a GET Request on the collection route.',

        'arguments'           => [

        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise',

        'routeSpecific'       => 'collection'
    ],

    'update' => [
        'name'                => 'update',

        'description'         => 'Makes a <code class="language-js">config.methods.update</code> Request.',

        'arguments'           => [
            [
                'name'        => 'id|data',
                'type'        => 'int|array|object',
                'description' => 'The id to be passed to the update request or the data to be passed to the update request.'
            ],
            [
                'name'        => 'data',
                'type'        => 'array|object',
                'description' => 'The data to be passed to the update request.'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
    ],

    'save' => [
        'name'                => 'save',

        'description'         => 'Alias of <code class="language-js">update()</code>.',

        'arguments'           => [

        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
    ],

    'destroy' => [
        'name'                => 'destroy',

        'description'         => 'Makes a <code class="language-js">config.methods.destroy</code> Request to the <code class="language-js">config.suffixes.destroy</code> route. If you wanted to send a request to a route that would destroy/delete your model, this would be how.',

        'arguments'           => [
            [
                'name'        => 'id',
                'type'        => 'int',
                'description' => 'The id to be passed to the destroy url. In other words, the id of the model you\'d like the destroy. <code class="language-markdown">/api/photo/`1`/destroy</code>'
            ],
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
    ],

    'create' => [
        'name'                => 'create',

        'description'         => 'Makes a <code class="language-js">config.methods.create</code> Request.',

        'arguments'           => [
            [
                'name'        => 'data',
                'type'        => 'array|object',
                'description' => 'The data to be passed to the create request.'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
    ],

    'id' => [
        'name'                => 'id',

        'description'         => 'Prefixes an id on the request.',

        'arguments'           => [
            [
                'name'        => 'id',
                'type'        => 'int',
                'description' => 'The id to be passed to the request.'
            ],
        ],

        'since'               => '0.0.1',

        'returns'             => 'rapid instance'
    ],

    'url' => [
        'name'                => 'url',

        'description'         => 'Builds the url for the request. Useful when extending rapid.',

        'arguments'           => [
            [
                'name'        => 'urlParams',
                'type'        => 'string|array',
                'description' => 'The parameters to set in the url.'
            ],

            [
                'name'        => 'prepend',
                'type'        => 'boolean',
                'description' => 'Whether or not to prepend',
                'default'     => 'false',
            ],

            [
                'name'        => 'overwrite',
                'type'        => 'boolean',
                'description' => 'Whether or not to overwrite any other urlParams',
                'default'     => 'false',
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'rapid instance'
    ],

    'get' => [
        'name'                => 'get',

        'description'         => 'Make a GET request.',

        'arguments'           => [
            [
                'name'        => '...urlParams',
                'type'        => 'string',
                'description' => 'A single string or comma delimeted values to build the request url'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'promise'
    ],

    'post' => [
        'name'                => 'post',

        'description'         => 'Make a POST request.',

        'arguments'           => [
            [
                'name'        => '...urlParams',
                'type'        => 'string',
                'description' => 'A single string or comma delimeted values to build the request url'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'promise'
    ],

    'put' => [
        'name'                => 'put',

        'description'         => 'Make a PUT request.',

        'arguments'           => [
            [
                'name'        => '...urlParams',
                'type'        => 'string',
                'description' => 'A single string or comma delimeted values to build the request url'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'promise'
    ],

    'patch' => [
        'name'                => 'patch',

        'description'         => 'Make a PATCH request.',

        'arguments'           => [
            [
                'name'        => '...urlParams',
                'type'        => 'string',
                'description' => 'A single string or comma delimeted values to build the request url'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'promise'
    ],

    'head' => [
        'name'                => 'head',

        'description'         => 'Make a HEAD request.',

        'arguments'           => [
            [
                'name'        => '...urlParams',
                'type'        => 'string',
                'description' => 'A single string or comma delimeted values to build the request url'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'promise'
    ],

    'delete' => [
        'name'                => 'delete',

        'description'         => 'Make a DELETE request.',

        'arguments'           => [
            [
                'name'        => '...urlParams',
                'type'        => 'string',
                'description' => 'A single string or comma delimeted values to build the request url'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'promise'
    ],

    'withParams' => [
        'name'                => 'withParams',

        'description'         => 'Send a set of params with the request.',

        'arguments'           => [
            [
                'name'        => 'params',
                'type'        => 'object',
                'description' => 'The params to be sent over'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'rapid instance'
    ],

    'withParam' => [
        'name'                => 'withParam',

        'description'         => 'Send a single param with the request.',

        'arguments'           => [
            [
                'name'        => 'key',
                'type'        => 'string',
                'description' => 'The key/name of the parameter'
            ],
            [
                'name'        => 'value',
                'type'        => 'string|object|array',
                'description' => 'The value of the parameter'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'rapid instance'
    ],

    'withOptions' => [
        'name'                => 'withOptions',

        'description'         => 'Send a set of options with the request.',

        'arguments'           => [
            [
                'name'        => 'options',
                'type'        => 'object',
                'description' => 'The options to be sent over'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'rapid instance'
    ],

    'withOption' => [
        'name'                => 'withOption',

        'description'         => 'Send a single option with the request.',

        'arguments'           => [
            [
                'name'        => 'key',
                'type'        => 'string',
                'description' => 'The key/name of the option'
            ],
            [
                'name'        => 'value',
                'type'        => 'string|object|array',
                'description' => 'The value of the option'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'rapid instance'
    ],

    'data' => [
        'name'                => 'data',

        'description'         => 'Send over both params and headers in one method.',

        'arguments'           => [
            [
                'name'        => 'data',
                'type'        => 'object',
                'description' => 'The data (params, headers) to be sent over'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'rapid instance'
    ]

];

return collect($methods)->map(function($method) {
    $method['prefix'] = 'methods';

    return $method;
})->toArray();
// ->sortBy('name')
