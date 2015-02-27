<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="fa" />
<link rel="stylesheet" type="text/css" href="<?php $path=PHP40::get()->homeUrl; echo $path; ?>public/css/main.css"  />
<script type="text/javascript">
function setFocus()
{
     document.getElementById("name").focus();
}
</script>
<title>QMB HRM</title>
</head>
<body onload="setFocus()">
	    <?php include(APP_ROOT."views/layouts/menu.php"); ?>
	    <div class="page">
	        <h2><?php if(isset($title)) echo $title; ?></h2>
	        <hr />
                <?php
					echo $form;
					if(isset($type)):
					?>
					<a href="<?php echo PHP40::get()->homeUrl; ?>index.php/lookup/manage/<?php echo $type; ?>" class="box">بازگشت</a>
					<?php endif; ?>
					</p>
					</form>
	    </div>
	      <?php include(APP_ROOT.'views/layouts/footer.php'); ?>
</body>
</html>