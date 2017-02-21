<?php

return [
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

        'returns'             => 'Promise'
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

        'returns'             => 'Promise'
    ],

    'all' => [
        'name'                => 'all',

        'description'         => 'Makes a GET Request on the collection route.',

        'arguments'           => [

        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
    ],

    'update' => [
        'name'                => 'update',

        'description'         => 'Makes a <code class="language-js">config.methods.update</code> Request on the collection route base off.',

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

    'hasRelationship' => [
        'name'                => 'hasRelationship',

        'description'         => 'Generates a GET Request to a relationship on a model/collection.',

        'arguments'           => [
            [
                'name'        => 'relation',
                'type'        => 'string',
                'description' => 'The relationship name. Given a post that has the relationship comments: <code class="language-markdown">/api/post/12/`comments`</code>'
            ],

            [
                'name'        => 'primaryKey',
                'type'        => 'int',
                'description' => 'The primaryKey for the model the relationship is being defined for. Given a post that has the relationship comments: <code class="language-markdown">/api/post/`12`/comments</code>'
            ],

            [
                'name'        => 'foreignKey|after',
                'type'        => 'string|int|array',
                'description' => 'The foreignKey for the the relationship or anything to be appended to the url. Given the above example, these attributes would go here: <code class="language-markdown">/api/post/12/comments/`id|int|array`</code>. If the following array is passed <code class="language-js">[\'latest\', \'meta\']</code> it would produce <code class="language-markdown">/api/post/12/comments/`latest`/`meta`</code>'
            ]
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
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
                'description' => 'The primaryKey for the model the relationship is being defined for. Given a post that has the relationship comments: <code class="language-markdown">/api/post/`12`/comments</code>'
            ],
        ],

        'since'               => '0.0.1',

        'returns'             => 'Promise'
    ]
];
