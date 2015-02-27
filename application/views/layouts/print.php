<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="fa" />
<link rel="stylesheet" type="text/css" href="<?php $path=PHP40::get()->homeUrl; echo $path; ?>public/css/print.css"  />
<script type="text/javascript" src="<?php  echo $path;?>public/jscript/print.js"></script>
<title>سامانه مدیریت منابع انسانی یاغیش- نسخه ۱</title>
</head>
<body>
<div id="page">
    <div class="content">
    	 <?php include($view); ?>
    </div>
</div>
<center><input type="button" onclick="printDiv('page')" value="چاپ" /></center>
</body>
</html>
