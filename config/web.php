<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [		
     /*	'view' => [
    		'theme' => [
    			'pathMap' => ['@app/views' => ['@app/themes/w3-by-lg', '@app/views']
    			],
    			'baseUrl' => '@web/../themes/w3-by-lg',
    		],	
    	],*/
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 't3pEM-8tvEVvdoK1VEVtIIf8X5H7d1Bz',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
    		
    	// BACKUP
    		/*
    		 'urlManager' => [
    		 'enablePrettyUrl' => true,
    		 'showScriptName' => false,
    		 'rules' => [
    		 ],
    		 ],
    		 */
        
        // Habilitando a se
        
        
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
	'modules' => [
			'gridview' =>  [
					'class' => '\kartik\grid\Module',
			]
	],
    'params' => $params,
];

if (YII_ENV_DEV) { //desativar isso tudo quando concluir tudo!
    // configuration adjustments for 'dev' environment
   // $config['bootstrap'][] = 'debug';
   // $config['modules']['debug'] = [
   //     'class' => 'yii\debug\Module',
   // ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module'
    ];
}

return $config;
