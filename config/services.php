<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'sandbox5002f2327085481fa8d7edb9b8faaeb4.mailgun.org',
        'secret' => 'key-13708e9cd62898e3e7635908e5a42998',
    ],

    'mandrill' => [
        // 'secret' => 'DN4FwFALFJLai_aAjxPQ_A', <-- This is the production key
        'secret' => 'MrRJc_QgJFYoCfswtw7A4g' // Test key
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'          => 'Models\Customer',
        'public_api_key' => 'pk_test_KegQTWJyXb8TnGwtu7CTcv6Y',
        'secret'         => 'sk_test_UwC9jEWOLr4MzFPsYDJLHOR4',
        'logo'           => '', // TODO: Create this
        'site_name'      => 'Just Pikd',
    ],

];
