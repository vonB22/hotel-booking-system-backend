<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | The default configuration below allows all origins,
    | all methods and all headers for the API routes. Change to restrict
    | origins to your front-end origin(s) in production.
    |
    */

    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
    ],

    'allowed_methods' => explode(',', env('CORS_ALLOWED_METHODS', '*')),

    'allowed_origins' => explode(',', env('CORS_ALLOWED_ORIGINS', '*')),

    'allowed_origins_patterns' => [],

    'allowed_headers' => explode(',', env('CORS_ALLOWED_HEADERS', '*')),

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
