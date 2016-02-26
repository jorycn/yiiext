<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
//----------------------------------------------------------------------------//
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
//----------------------------------------------------------------------------//
	'name' => 'EDS Тестовое задание',
//----------------------------------------------------------------------------//
	'defaultController' => 'site',
//----------------------------------------------------------------------------//
	'controllerMap' => array(
		'user' => array(
			'class' => 'application.controllers.UserController',
			'pageTitle' => 'user'
		),
		'role' => array(
			'class' => 'application.controllers.RoleController',
			'pageTitle' => 'role'
		),
		'site' => array(
			'class' => 'application.controllers.SiteController',
			'pageTitle' => 'EDS Тестовое задание',
		),
	),
//----------------------------------------------------------------------------//
	// preloading 'log' component
	'preload' => array('log'),
//----------------------------------------------------------------------------//
	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
	),
//----------------------------------------------------------------------------//
	'modules' => array(
		// uncomment the following to enable the Gii tool
		/*
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '1q2w3e4r',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),
		*/
	),
//----------------------------------------------------------------------------//
	// application components
	'components' => array(
//----------------------------------------------------------------------------//
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
//----------------------------------------------------------------------------//
		'session' => array(
			'autoStart' => true
		),
//----------------------------------------------------------------------------//
		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
//----------------------------------------------------------------------------//
		'format' => array(
			'booleanFormat' => array('Нет', 'Да'),
			'dateFormat' => 'd.m.Y H:i:s'
		),
//----------------------------------------------------------------------------//
		// uncomment the following to use a MySQL database
		'db' => array(
			'connectionString' => 'mysql:host=' . DB_CONST::HOST . ';dbname=' . DB_CONST::NAME,
			'emulatePrepare' => true,
			'username' => DB_CONST::USER,
			'password' => DB_CONST::PASSWORD,
			'charset' => 'utf8',
		),
//----------------------------------------------------------------------------//
		'authManager' => array(
			'class' => 'CPhpAuthManager',
		),
//----------------------------------------------------------------------------//
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
//----------------------------------------------------------------------------//
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning, info, trace',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class' => 'CWebLogRoute',
				),
				*/
			),
		),
	),
//----------------------------------------------------------------------------//
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
//		PARAMS_CONST::EXT_JS_PATH => '../../extjs',
		'adminEmail' => 'webmaster@example.com',
//----------------------------------------------------------------------------//
	),
);
/******************************************************************************/
?>