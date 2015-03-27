<!DOCTYPE html>
<html lang="fa">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="<?php $path = PHP40::get() -> homeUrl;echo $path; ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?php echo $path; ?>public/jquery-ui-1.11.4/jquery-ui.theme.css" rel="stylesheet">
          <link href="<?php echo $path; ?>public/jtable.2.4.0/themes/metro/green/jtable.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>public/css/main.css" >
        <title>سامانه مدیریت منابع انسانی یاغیش</title>
        <?php include 'favicon.php';?>
    </head>
<body><div class="container-fluid"><?php include('menu.php'); ?>
    <div class="header-reserve"></div>
    <h2 class="bigtitle">
            <?php if (isset($title)) echo($title); ?>
        </h2>
        <div id="view">
        <?php include($view); ?>
        </div>
        <div class="footer-reserve"></div>
        <?php include 'footer.php'; ?>
    </div>
<script type="text/javascript" src="<?php echo $path; ?>public/jscript/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>public/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>public/jtable.2.4.0/jquery.jtable.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>public/jtable.2.4.0/localization/jquery.jtable.fa.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>public/jscript/focus.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>public/jscript/spin.min.js"></script>
<?php if (isset($scripts)) echo $scripts; ?></body></html>