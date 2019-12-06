<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [

        'cart'=> [
          'class'=>'frontend\components\Cart'
        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => 'your siteKey v2',
            'secretV2' => 'your secret key v2',
            'siteKeyV3' => getenv('GOOGLE_RECAPTCHA'),
            'secretV3' =>getenv('GOOGLE_SERVER_RECAPTCHA'),
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login'=>'/site/login',
                'signup'=>'/site/signup',
                'about'=>'/site/about',
                'return-policy' => '/site/return-policy',
                'turbo-problems' => '/site/turbo-problems',
                'delivery' => '/site/delivery',
                'contact' => '/site/contact',
                'faq' => '/site/faq',
                'logout' => '/site/logout',
                'cart/delete-item/<id:\d+>' => 'cart/delete-item',
                'cart/get-cart' => 'cart/get-cart',
                'products' => '/store/products',
                'turbo-actuator' => '/store/turbo-actuator',
                'store/view' => '/store/view',
                'turbo-actuator-position-sensor' => '/store/turbo-actuator-position-sensor',
                'turbo-charger' => '/store/turbo-charger',
                'turbo-cleaner' => '/store/turbo-cleaner',
                'news' => '/site/news'
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],

    ],
    'params' => $params,
];
