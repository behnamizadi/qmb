<!DOCTYPE html>
<html lang="fa">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="<?php $path = PHP40::get() -> homeUrl;echo $path; ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <title>سامانه مدیریت منابع انسانی یاغیش</title>
 <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>public/css/shared.css" >
        <?php include 'favicon.php';?>
        <link rel="stylesheet" type="text/css" href="<?php $path=PHP40::get()->homeUrl; echo $path; ?>public/css/print.css"  />
        <script type="text/javascript" src="<?php  echo $path;?>public/jscript/print.js"></script>
    </head>
<body>
<div id="page">
    <div class="content">
    	<img src="<?php echo $path; ?>pics/<?php echo $picture; ?>" alt="عکس پرسنلی" width="100"  class="img-thumbnail" style="float:left" align="middle" style="display: inline" />
        <h1>«خلاصه وضعیت پرسنلی»</h1>
        <table class="table table-bordered table-striped" >
            <tr>
                <td>نام خانوادگی: <?php echo $profile->lastname; ?></td>
                <td>تاریخ تولد: <?php echo $profile->date_born; ?></td>
                <td>وضعیت تاهل: <?php echo ($profile->married == 1) ? 'مجرد' : 'متاهل'; ?></td>
            </tr>
            <tr>
                <td>نام: <?php echo $profile->name; ?></td>
                <td>محل تولد: <?php echo $profile->city_born; ?></td>
                <td>تعداد افراد تحت تکفل: <?php echo $profile->takafol; ?></td>
            </tr>
            <tr>
                <td>کد پرسنلی: <?php echo $clerk_number; ?></td>
                <td>محل صدور: <?php echo $profile->city_sodur; ?></td>
                <td>وضعیت اشتغال همسر: <?php echo $spouseJob; ?></td>
            </tr>
            <tr>
                <td>نام پدر: <?php echo $profile->father; ?></td>
                <td>شماره شناسنامه: <?php echo $profile->sh_sh; ?></td>
                <td>کد ملی: <?php echo $profile->code_melli; ?></td>
            </tr>
            <tr>
            	<td>تاریخ استخدام: <?php echo $dateEmployed ; ?></td>
                <td>سابقه بانکی: <?php echo $timeEmployed ; ?></td>
                <td>مذهب: <?php echo $profile->religion; ?></td>
            </tr>
            <tr>
                <td colspan="2">محل خدمت سازمانی: <?php echo $jobPlace; ?></td>
            </tr>
        </table>
        <p class="caption">سیر تحصیلات</p>
        <?php echo $education; ?>
        <p class="caption">سیر مشاغل</p>
        <?php echo $carrier; ?>
        <p class="caption">نمرات ارزشیابی</p>
        <table class="table table-bordered table-striped">
		<tr>
		<?php foreach($evResult as $year=>$grade): ?>
			<th class="grid_th">سال <?php echo $year; ?></th>
		<?php endforeach; ?>
		</tr>
		<tr>
		<?php foreach($evResult as $year=>$grade): ?>
			<td><?php echo $grade; ?></td>
		<?php endforeach; ?>
		</tr>
        </table>
        <div style="margin-top:10px;">
        	<div style="width:30%;float:right">تعداد تشویق: <?php echo $p1Count; ?></div>
        	<div style="width:30%;float:right;text-align:center">تعداد تنبیه: <?php echo $p2Count; ?></div>
        	<div style="width:30%;float:left;text-align:left">تعداد دوره آموزشی گذرانده: <?php echo $tCount; ?></div>
        </div>
    </div>
    <?php if(isset($producer)) echo $producer; ?>
</div>
<center><input type="button" onclick="printDiv('page')" value="چاپ" /></center>
</body>
</html>