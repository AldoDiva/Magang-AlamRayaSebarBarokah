<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyDbn2bZBXBiIRqLcf_rbwOuFsB4bJsc76k',
        'auth_domain' => 'fluttercrud-941e8.firebaseapp.com',
        'database_url' => 'https://fluttercrud-941e8-default-rtdb.asia-southeast1.firebasedatabase.app',
        'project_id' => 'fluttercrud-941e8',
        'storage_bucket' => 'fluttercrud-941e8.appspot.co',
        'messaging_sender_id' => '1086962084026',
        'app_id' => '1:1086962084026:web:50a3c2a876e197df3ffa83',
        'measurement_id' => 'G-YZR66Z6EQB',
    ],

];
