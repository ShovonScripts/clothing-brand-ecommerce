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

];
