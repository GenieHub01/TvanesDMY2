<?php
use kartik\datecontrol\Module;
return [
    // format settings for displaying each date attribute (ICU format example)
    'dateControlDisplay' => [
        Module::FORMAT_DATE => 'dd-MM-yyyy',
        Module::FORMAT_TIME => 'hh:mm:ss a',
        Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a',
    ],

    // format settings for saving each date attribute (PHP format example)
    'dateControlSave' => [
        Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],
    'bsVersion' => '4.x',
    'adminEmail' => 'admin@'.getenv('MAILGUN_DOMAIN'),
    'supportEmail' => 'support@'.getenv('MAILGUN_DOMAIN'),
    'senderEmail' => 'noreply@'.getenv('MAILGUN_DOMAIN'),
    'senderName' => 'mailer',
    'user.passwordResetTokenExpire' => 3600,
    'GoogleJsAPI' => getenv('GOOGLE_JS_API'),
    'GoogleServerAPI' => getenv('GOOGLE_SERVER_API'),
    'GoogleAnalytics' => getenv('GOOGLE_ANALYTICS'),
    'SHIPPINGCOST' => getenv('SHIPPINGCOST'),
    'HOLDINGCHARGE' => getenv('HOLDINGCHARGE'),
    'tax'=>[
     1=>   getenv('T1'),
     2=>   getenv('T2'),
     3=>   getenv('T3'),
//     'T4'=>   getenv('T4'),
//     'T5'=>   getenv('T5'),
//     'T6'=>   getenv('T6'),
//     'T7'=>   getenv('T7'),
//     'T8'=>   getenv('T8'),
//     'T9'=>   getenv('T9'),
//     'T10'=>   getenv('T10'),
    ]
];
