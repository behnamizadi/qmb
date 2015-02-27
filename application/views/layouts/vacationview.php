<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="fa" />
<link rel="stylesheet" type="text/css" href="<?php $path=PHP40::get()->homeUrl; echo $path; ?>public/css/print.css"  />
<script type="text/javascript" src="<?php  echo $path;?>public/jscript/print.js"></script>
<title>خلاصه مرخصی</title>
</head>
<body>
<div id="page">
    <div class="content">
        <h1>«خلاصه مرخصی <?php echo $title; ?>»</h1>
        <?php echo $grid;  ?>
        <br />
        <h2>خلاصه کل مرخصی‌ها در سال <?php echo $y; ?></h2>
        <?php echo $detail;  ?>
        <?php if(isset($producer)) echo $producer; ?>
    </div>
</div>
<center><input type="button" onclick="printDiv('page')" value="چاپ" /></center>
</body>
</html>