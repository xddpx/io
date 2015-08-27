<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
        'io' => [
            'class' => 'frontend\modules\io\Module',
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/pixel/views/',
                    '@app/views/layouts' => '@app/themes/pixel/layouts/',
                    '@app/modules' => '@app/themes/pixel/modules',
                    '@app/widgets' => '@app/themes/pixel/widgets',
                    '@app/mail' => '@app/themes/pixel/mail'
                ],
                'baseUrl' => '@web/themes/pixel',
            ],
        ],
        'user' => [
            'identityClass' => 'frontend\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/auth/signin'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array_merge(
                    require(__DIR__ . '/../../common/config/url_rules.php'), require(__DIR__ . '/url_rules.php')),
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'baseUrl' => '',
        ],
        'socket' => [
            'class' => 'frontend\modules\io\components\Socket',
            'host' => 'aptaid.dev',
            'port' => 9000
        ],
    ],
    'params' => $params,
];
