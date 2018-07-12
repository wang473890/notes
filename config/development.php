<?php


return [
    'id' => 'notes-development',
    'basePath' => dirname(__DIR__),
//    'bootstrap' => ['gii'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/' . date("Ymd") . '/error.log'
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [],
                    'logFile' => '@runtime/logs/' . date("Ymd") . '/all.log'
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['trace'],
                    'logFile' => '@runtime/logs/' . date("Ymd") . '/trace.log'
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=140.143.234.207;dbname=notes',
            'username' => 'wg',
            'password' => 'wanggang123',
            'charset' => 'utf8',
        ],

    ],

    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
        ]
    ],
];
