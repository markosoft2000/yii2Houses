<?php
return [
    'name' => 'Marko Yii2 Project',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'cacheBase64' => [
            'class' => 'common\cache\Base64Cache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'pages/<view:[a-zA-Z0-9-]+>' => 'main/main/page',
                'property-detail/<id:\d+>' => 'main/main/property-detail',
                'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>',
                'cabinet/advert/<action:(view|update|delete)>/<id:\d+>' => 'cabinet/advert/<action>',
                'logout' => 'site/logout'
            ],
        ],
    ],
];
