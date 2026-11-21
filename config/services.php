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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    /*
     * SMS gateway used by the SendSms() helper in app/helpers.php.
     * Leave SMS_URL / SMS_API_KEY empty to disable SMS sending entirely.
     * Query parameter names in the helper may need adjusting for your provider.
     */
    'sms' => [
        'url' => env('SMS_URL'),
        'apikey' => env('SMS_API_KEY'),
        'secretkey' => env('SMS_SECRET_KEY'),
        'sender_id' => env('SMS_SENDER_ID'),
    ],

    /*
     * Courier services configuration.
     * Credentials should be stored in .env and referenced here.
     * Database fields are deprecated and will be removed.
     */
    'redx' => [
        'base_url' => env('REDX_API_BASE_URL', 'https://sandbox.redx.com.bd/v1.0.0-beta'),
        'access_token' => env('REDX_API_ACCESS_TOKEN'),
    ],

    'pathao' => [
        'base_url' => env('PATHAO_API_BASE_URL', 'https://sandbox-apis.pathao.com'),
        'access_token' => env('PATHAO_API_ACCESS_TOKEN'),
        'store_id' => env('PATHAO_STORE_ID'),
    ],

    'steadfast' => [
        'base_url' => env('STEADFAST_API_BASE_URL', 'https://portal.packzy.io/api/v1'),
        'api_key' => env('STEADFAST_API_KEY'),
        'secret_key' => env('STEADFAST_SECRET_KEY'),
    ],

];