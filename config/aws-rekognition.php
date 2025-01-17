<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AWS credentials
    |--------------------------------------------------------------------------
    |
    | Here you may specify the credentials for AWS used to sign requests.
    | See https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.AwsClient.html#method___construct for more information.
    |
    */
    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | AWS region
    |--------------------------------------------------------------------------
    |
    | Here you may specify the region to connect to.
    | See https://docs.aws.amazon.com/general/latest/gr/rande.html for a list of available regions.
    */
    'region'      => env('AWS_REGION', 'us-east-1'),

    /*
    |--------------------------------------------------------------------------
    | AWS version of the webservice to utilize (e.g., 2006-03-01)
    |--------------------------------------------------------------------------
    |
    | Here you may specify the version of the webservice.
    | See https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.AwsClient.html#method___construct for more information.
    */
    'version'     => env('AWS_VERSION', 'latest'),
];