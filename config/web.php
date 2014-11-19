<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'spacebox-test',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'ZFxLx3_P4PpB91DOBsVRbigDk3u37ucd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'db' => require(__DIR__ . '/local/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {

    // if app running in dev env then let enable debug and gii
    $allowed = [$_SERVER['REMOTE_ADDR']];

    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => $allowed,
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => $allowed,
    ];
}

return $config;
