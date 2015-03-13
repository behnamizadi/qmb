<?php
//ob_start("ob_gzhandler");
date_default_timezone_set('Asia/Tehran');
error_reporting(E_ALL);
//ini_set('display_errors',1);
define('ROOT',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('APP_ROOT',ROOT.'application'.DIRECTORY_SEPARATOR);
define('FRAMEWORK','../PHP40h/');
//echo $php40;exit();
$config = ROOT.'application/config/config.php';
require_once(FRAMEWORK.'PHP40.php');
PHP40::get()->init($config);
//ob_flush();?>