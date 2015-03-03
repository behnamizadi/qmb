<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="fa" />
<link rel="stylesheet" type="text/css" href="<?php $path=PHP40::get()->homeUrl; echo $path; ?>public/css/main.css"  />
<script type="text/javascript" src="<?php  echo $path;?>public/jscript/jquery-1.8.3.min.js"></script>
<script src="<?php echo $path;?>public/jscript/focus.js"></script>
<title>سامانه مدیریت منابع انسانی یاغیش- نسخه ۱</title>
</head>
<body>
	    <?php include("menu.php"); ?>
	    <div class="page">
	        <h2><?php if(isset($title)) echo $title; ?></h2>
	        <hr />
                <?php include($view); ?>
	    </div>
	      <?php include('footer.php'); ?>
</body>
</html>
