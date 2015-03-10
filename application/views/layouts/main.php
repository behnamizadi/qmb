<!DOCTYPE html>
<head>
<meta charset="UTF-8">
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
