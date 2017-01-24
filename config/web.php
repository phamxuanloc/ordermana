<?php
$params  = require(__DIR__ . '/params.php');
$baseUrl = str_replace('/web', '', (new \yii\web\Request)->getBaseUrl());
$config  = [
	'id'               => 'basic',
	'basePath'         => dirname(__DIR__),
	'bootstrap'        => ['log'],
	'on beforeRequest' => function () {
		$user = Yii::$app->user->identity;
		if($user) {
			Yii::$app->setTimeZone('Asia/Ho_Chi_Minh');
		}
	},
	'components'       => [
		'request'      => [
			'baseUrl'             => $baseUrl,
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'UiYabNEldT-r477hhA64lX2fzAy9Gyct',
		],
		'cache'        => [
			'class' => 'yii\caching\FileCache',
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer'       => [
			'class'            => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log'          => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets'    => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => [
						'error',
						'warning',
					],
				],
			],
		],
		'db'           => require(__DIR__ . '/db.php'),
		'urlManager'   => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'rules'           => [
			],
		],
		'view'         => [
			'theme' => [
				'pathMap' => [
					'@dektrium/user/views' => '@app/views/user',
				],
			],
		],
		'setting'      => [
			'class' => 'navatech\setting\Setting',
		],
	],
	'modules'          => [
		'user'     => [
			'class'         => 'dektrium\user\Module',
			'modelMap'      => [
				'User'       => 'app\models\User',
				//IMPORTANT & REQUIRED, change to your User model if overridden
				'LoginForm'  => 'navatech\role\models\LoginForm',
				//IMPORTANT & REQUIRED
				'UserSearch' => 'app\models\search\UserSearch',
			],
			'controllerMap' => [
				'admin' => 'app\controllers\AdminController',
			],
		],
		'setting'  => [
			'class'               => 'navatech\setting\Module',
			'controllerNamespace' => 'navatech\setting\controllers',
		],
		'roxymce'  => [
			'class'     => 'navatech\roxymce\Module',
			'uploadUrl' => 'uploads/images',
		],
		'role'     => [
			'class'       => 'navatech\role\Module',
			'controllers' => [ //namespaces of controllers
				'app\controllers',
				'navatech\role\controllers',
			],
		],
		'gridview' => [
			'class' => '\kartik\grid\Module',
		],
	],
	'params'           => $params,
];
if(YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
//	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
	];
	$config['bootstrap'][]      = 'gii';
	$config['modules']['gii']   = [
		'class' => 'yii\gii\Module',
	];
}
return $config;
