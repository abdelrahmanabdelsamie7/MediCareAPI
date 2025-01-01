<?php

use App\Models\Admin;
use App\Models\Doctor;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    // -------------------------
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
        'doctors' => [
            'driver' => 'jwt',
            'provider' => 'doctors',
        ],
        'admins' => [
            'driver' => 'jwt',
            'provider' => 'admins',
        ]
    ],
    // -------------------------
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'doctors' => [
            'driver' => 'eloquent',
            'model' => Doctor::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ],

    ],
    // -------------------------
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

    ],
    // -------------------------
    'password_timeout' => 10800,
];
