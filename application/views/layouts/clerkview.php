<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="fa" />
<link rel="stylesheet" type="text/css" href="<?php $path=PHP40::get()->homeUrl; echo $path; ?>public/css/print.css"  />
<script type="text/javascript" src="<?php  echo $path;?>public/jscript/print.js"></script>
<script type="text/javascript" src="<?php  echo $path;?>public/jscript/jquery-1.8.3.min.js"></script>
<script src="<?php echo $path;?>public/jscript/focus.js"></script>
<title>خلاصه وضعیت پرسنلی</title>
</head>
<body>
<div id="page">
    <div class="content">
    	<img src="<?php echo $path; ?>pics/<?php echo $picture; ?>" alt="عکس پرسنلی" width="100"  style="float:left" align="middle" style="display: inline" />
        <h1>«خلاصه وضعیت پرسنلی»</h1>
        <table style="width:160mm; table-layout: fixed;">
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
                <td>شماره کارمندی: <?php echo $clerk_number; ?></td>
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
        <table class="clist">
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