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
		'yii2images' => [
			'class' => 'rico\yii2images\Module',
			//be sure, that permissions ok
			//if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
			'imagesStorePath' => 'upload/store', //path to origin images
			'imagesCachePath' => 'upload/cache', //path to resized copies
			'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
			'placeHolderPath' => '@webroot/upload/store/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
			'imageCompressionQuality' => 100, // Optional. Default value is 85.
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
				'<action:(about|contact|login)>' => 'site/<action>',
//				'<action:(\w+)>' => 'site/<action>'
				'category/<id:\d+>/page/<page:\d+>' => 'category/view',
				'category/<id:\d+>' => 'category/view',
				'product/<id:\d+>' => 'product/view',
				'search' => 'category/search',
				'delete/<id:\d+>/<id_img:\d+>' => 'admin/product/delete-img',
				'cabinet' => 'cabinet/index',
				'signup' => 'site/signup',
			],
		],

    ],

	'controllerMap' => [
		'elfinder' => [
			'class' => 'mihaildev\elfinder\PathController',
			'access' => ['@'],
			'root' => [
				'baseUrl'=>'/web',
				//'basePath'=>'@webroot',
				'path' => 'upload/global',
				'name' => 'Global'
			],
//			'watermark' => [
//				'source'         => __DIR__.'/logo.png', // Path to Water mark image
//				'marginRight'    => 5,          // Margin right pixel
//				'marginBottom'   => 5,          // Margin bottom pixel
//				'quality'        => 95,         // JPEG image save quality
//				'transparency'   => 70,         // Water mark image transparency ( other than PNG )
//				'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
//				'targetMinPixel' => 200         // Target image minimum pixel size
//			]
		]
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
