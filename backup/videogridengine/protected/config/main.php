<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
define('JUI-THEME','dark-hive');
return array(
    
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Finding Footage Video Searching',
        
    'theme'=>'fftheme',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                 'ext.giix-components.*', // giix components
             'application.modules.users.models.*'
			
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
            
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
                    'generatorPaths' => array(
			'ext.giix-core', // giix generators
                        ),
			'password'=>'admin123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('*'),
		),
             
        
           
             'users',
    
            

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
                        'loginUrl'=>get_site_url().'/wp-login.php',
                    
		),
            'videoservices'=>array('class'=>'VideoServices'),
            'CURL' =>array(
'class' => 'application.extensions.curl.Curl',
     //you can setup timeout,http_login,proxy,proxylogin,cookie, and setOPTIONS
     
     //eg.
   'options'=>array(
        'timeout'=>600,

   ),               
),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		 
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=findingf_live',
               //   'connectionString' => 'mysql:host=localhost;dbname=findingfootage',
			'emulatePrepare' => true,
			'username' => 'findingf_live',
			'password' => 'D@coders0333',
			'charset' => 'utf8',
		),
		 
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
//                                array(
//                'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
//                'ipFilters'=>array('*'),
//            ),
				
//				array(
//					'class'=>'CWebLogRoute',
//				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@findingfootage.com',
                    'selected_num_item'=>'50',
            'paginationcols'=>'25,50,75,100',
	//		'apiservicesurl'=>'http://localhost/findingfootageproject1/ffservices/public/index.php',	
           'apiservicesurl'=>'http://www.findingfootage.com/ffservices/public/index.php',
	),
   
    
);
