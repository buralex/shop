<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language' => 'en',
	'defaultRoute' => 'category/index',
	'modules' => [
		'admin' => [
			'class' => 'app\modules\admin\Module',
			'layout' => 'admin',
			'defaultRoute' => 'order/index',
		],
	],
//	'layout' => 'basic',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9YpGBn8NVkhGjH_OuDvQmfrJ_Tpo-EpG',
			'baseUrl'=> '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
//			'loginUrl' => 'cart/view'  // when click login - redirect to cart/view
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.gmail.com',
				'username' => 'shoptesttask@gmail.com',
				'password' => 'test123temp',
				'port' => '587',
				'encryption' => 'tls',
			],
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
        'db' => $db,

		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
//				'<action:(about|contact|login)>' => 'site/<action>',
//				'<action:(\w+)>' => 'site/<action>'
				'category/<id:\d+>/page/<page:\d+>' => 'category/view',
				'category/<id:\d+>' => 'category/view',
				'product/<id:\d+>' => 'product/view',
				'search' => 'category/search'
			],
		],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['77.247.17.94', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
		'allowedIPs' => ['77.247.17.94', '::1'],
    ];
}

return $config;
