<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
return array(
	'defines'=>array(
		'admin_email'=>'mgaghdam@gmail.com',
	),
	'homeUrl'=>'/qmb/',
	'appName'=>'سامانه مدیریت منابع انسانی یاغیش- نسخه ۱.۱',
	'language'=>'persian',
	'debug'=>FALSE,
	/*
	 * routing related params
	 */
	'route'=>array(
	    'defaultController'=>'user',
		'defaultAction'=>'login',
		'showIndex'=>TRUE,
	),
	'view'=>array(
		'messageView'=>'site/message',
		'layout'=>'main',
		'404'=>'site/404',
		'401'=>'site/401',
	),
	'database'=>array(
		'default'=>array(
			'database'=>'qmb',
			'host'=>'localhost',
			'user'=>'root',
			'password'=>'',
			'charset'=>'utf8',
			'perfix'=>'tbl_'
		),
	),
	//these are accessable via 'PHP40::get()' : 'role'(if set),'username','user'(if set),'username','loginTime',
	//e.g,PHP40::get()->user or PHP40::get()->loginTime
	'auth'=>
		array(  //default or admin: the type which comes with CAuth construct
			'default'=>array(
				'database'=>array(
					'table'=>'tbl_user',
					'username'=>'username', //username field in login form corresponding database
					'password'=>'password', //password field in login form corresponding database
					'user'=>'id',//note that it must exist in table.If not set 'username' will be used instead
					'role'=>'role', //role field to be set in session(if it has any). if set role out of database array does not have effect
					//'condition'=>array('is_allowed'=>1),
					),
				'passwordCoding'=>'sha1',
				//'role'=>'user',
				'cookie'=>array( 
					'use'=>TRUE, //if you wanna use autologin feature set this TRUE
					'field'=>'rememberMe', //the field in login form
					),
				//'errorMessage'=>'mixed',
			),
			'admin'=>array(
				'database'=>array(
					'table'=>'tbl_admin',
					'username'=>'username',
					'password'=>'password',
					'user'=>'id',
				),
				'role'=>'admin',//set the role to admin
				'cookie'=>array( 
						'use'=>TRUE, //if you wanna use autologin feature set this TRUE
						'field'=>'rememberMe', //the field in login form
						),
			)
		),
);
?>
