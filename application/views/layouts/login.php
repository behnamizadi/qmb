<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="fa" />
<link rel="stylesheet" type="text/css" href="<?php $path=PHP40::get()->homeUrl; echo $path; ?>public/css/main.css"  />
<script type="text/javascript" src="<?php echo $path;?>public/jscript/jquery-1.8.3.min.js"></script>
<script src="<?php echo $path;?>public/jscript/focus.js"></script>
<title>سامانه مدیریت منابع انسانی یاغیش- نسخه ۱</title>
 <?php include 'favicon.php';?>
</head>
<body>
    <div class="background-container">
   <img class="background-image" src="<?php echo $path;?>public/images/qmbg.jpg" />
   </div>
    <div class="radius container ">
            
        <div class="page">
             <h2 class="bigtitle">سامانه مدیریت منابع انسانی بانک قرض‌الحسنه مهر ایران</h2>
            <div class="wrap">
                <?php include($view); ?>
            </div>
          
        </div>
    </div><!-- container -->
</body>
</html>
