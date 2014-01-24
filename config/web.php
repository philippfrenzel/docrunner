<?php
$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
	'charset'=>'UTF-8',
  'language' => 'en_US',
  //'language' => 'de_DE',
	'modules' => [
		 'user' => 'dektrium\user\Module',
		 'comments' => [
				'class' => 'app\modules\comments\Comments'
			],
	    'messaging' => [
	      'class' => 'app\modules\messaging\Messaging'
	    ],		
	    'revision' => [
	        'class' => 'app\modules\revision\Revision',
	    ],
	    'tasks' => [
	        'class' => 'app\modules\tasks\Task',
	    ],
	    'workflow' => [
	        'class' => 'app\modules\workflow\Workflow',
	    ],
	    'pages' => [
	        'class' => 'app\modules\pages\Pages',
	    ],
	    'tags' => [
	        'class' => 'app\modules\tags\Tags',
	    ],
	    'posts' => [
	        'class' => 'app\modules\posts\Posts',
	    ],
	    'parties' => [
          'class' => 'app\modules\parties\parties',
      ],
      'purchase' => [
          'class' => 'app\modules\purchase\purchase',
      ],
      'article' => [
          'class' => 'app\modules\article\article',
      ],
      'dms' => [
          'class' => 'app\modules\dms\dms',
      ],
	],
	'components' => [
    'urlManager'=>[
      'enablePrettyUrl' => false
    ],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'assetManager' => [
      'converter'=>[
        'class'=>'nizsheanez\assetConverter\Converter',
        'force'=>true, // true : If you want convert your sass each time without time dependency
        'destinationDir' => 'assets', //at which folder of @webroot put compiled files
        'parsers' => [
          'less' => [ // file extension to parse
            'class' => 'nizsheanez\assetConverter\Less',
            'output' => 'css', // parsed output file type
            'options' => [
               //'auto' => true, // optional options
            ]
          ]
        ]
      ]
    ],
		'user' => [
      'class' => 'app\components\User',
    ],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mail' => [
			'class' => 'yii\swiftmailer\Mailer',
			'transport' => [        
        'class'        => 'Swift_SmtpTransport',
        'host'         => 'smtp.example.com',
        'username'     => 'sample',
        'password'     => 'secret'
			],
      'messageConfig' => [
        'from'         => 'noreply@open-intra.net'
      ]
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
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=docrunner;unix_socket=/tmp/mysql5.sock',
			'username' => 'dbuser',
			'password' => 'dbpass',
			'charset' => 'utf8',
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['preload'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';
	$config['modules']['gii'] = 'yii\gii\Module';
}

if (YII_ENV_TEST) {
	// configuration adjustments for 'test' environment.
	// configuration for codeception test environments can be found in codeception folder.

	// if needed, customize $config here.
}

return $config;
