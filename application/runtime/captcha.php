<?php 
	require_once("/var/www/hrm/../PHP40/core/captcha/CCaptcha.php");
	$obj = new CCaptcha;$obj->textLength= '4';
	$obj->height= '35';$obj->fontSize= '23';
	$obj->backgroundColor= '#F5F5F5';
	$obj->captchaField='captcha';
	$obj->generateRandom();
	require_once("/var/www/hrm/../PHP40/core/CSession.php");
	$session = new CSession;
	$session->set("captcha",md5($obj->getCode()));
	$obj->generateImage();
?>