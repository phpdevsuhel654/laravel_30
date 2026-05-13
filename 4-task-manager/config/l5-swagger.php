<?php

return [
    'api' => [
        /*
        |--------------------------------------------------------------------------
        | Edit to set the api's title
        |--------------------------------------------------------------------------
         */

        'title' => 'Task Manager API',

    ],

    'routes' => [
        /*
        |--------------------------------------------------------------------------
        | Disable the swagger-ui route so we can use ours
        |--------------------------------------------------------------------------
         */

        'api' => 'api/documentation',
        'docs' => 'api/docs',
        'oauth2_callback' => 'api/oauth2-callback',
        'middleware' => ['api'],
    ],

    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Paths where the swagger will search for comments to build docs
        |--------------------------------------------------------------------------
         */

        'annotations' => base_path('app/Http/Controllers/Api'),
    ],
];
