<?php require_once("C:\xamp\htdocs\qmb\../PHP40h/core/captcha/CCaptcha.php");$obj = new CCaptcha;$obj->textLength= '6';$obj->captchaField='captcha'; $obj->generateRandom(); 
        require_once("C:\xamp\htdocs\qmb\../PHP40h/core/CSession.php"); $session = new CSession;
        $session->set("captcha",md5($obj->getCode())); $obj->generateImage();?>