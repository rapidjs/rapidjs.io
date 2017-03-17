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

    // 'hasRelationship' => [
    //     'name'                => 'hasRelationship',
    //
    //     'description'         => 'Generates a GET Request to a relationship on a model/collection.',
    //
    //     'arguments'           => [
    //         [
    //             'name'        => 'relation',
    //             'type'        => 'string',
    //             'description' => 'The relationship name. Given a post that has the relationship comments: <code class="language-markdown">/api/post/12/`comments`</code>'
    //         ],
    //
    //         [
    //             'name'        => 'primaryKey',
    //             'type'        => 'int',
    //             'description' => 'The primaryKey for the model the relationship is being defined for. Given a post that has the relationship comments: <code class="language-markdown">/api/post/`12`/comments</code>'
    //         ],
    //
    //         [
    //             'name'        => 'foreignKey|after',
    //             'type'        => 'string|int|array',
    //             'description' => 'The foreignKey for the the relationship or anything to be appended to the url. Given the above example, these attributes would go here: <code class="language-markdown">/api/post/12/comments/`id|int|array`</code>. If the following array is passed <code class="language-js">[\'latest\', \'meta\']</code> it would produce <code class="language-markdown">/api/post/12/comments/`latest`/`meta`</code>'
    //         ]
    //     ],
    //
    //     'since'               => '0.0.1',
    //
    //     'returns'             => 'Promise'
    // ],

    'hasOne' => [
        'name'                => 'hasOne',

        'description'         => '',

        'arguments'           => [

        ],

        'since'               => '0.0.1',

        'returns'             => 'this'
    ],

    'hasMany' => [
        'name'                => 'hasMany',

        'description'         => '',

        'arguments'           => [

        ],

        'since'               => '0.0.1',

        'returns'             => 'this'
    ],

    'belongsTo' => [
        'name'                => 'belongsTo',

        'description'         => 'Generates a GET Request to a relationship that the given collection belongs to.',

        'arguments'           => [
            [
                'name'        => 'relation',
                'type'        => 'string',
                'description' => 'The relationship name. Given comments that belong to a post: <code class="language-markdown">/api/`post`/12/comments</code>'
            ],

            [
                'name'        => 'primaryKey',
                'type'        => 'int',
                'description' => 'The primaryKey for the belongsTo relationship. Given the above example, this would be the post\'s id: <code class="language-markdown">/api/post/`12`/comments</code>'
            ],

            [
                'name'        => 'foreignKey',
                'type'        => 'string|int',
                'description' => 'The foreignKey for the the relationship or anything to be appended to the url. Given the above example, these attributes would go here: <code class="language-markdown">/api/post/12/comments/`id|int|array`</code>. If the following array is passed <code class="language-js">[\'latest\', \'meta\']</code> it would produce <code class="language-markdown">/api/post/12/comments/`latest`/`meta`</code>'
            ],

            [
                'name'        => 'after',
                'type'        => 'int|string|array',
                'description' => 'The primaryKey for the model the relationship is being defined for. Given a post that has the relationship comments: <code cs="language-markdown">/api/post/`12`/comments</code>'
            ],
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
    ]
];

return collect($methods)->map(function($method) {
    $method['prefix'] = 'methods';

    return $method;
})->sort()->toArray();
