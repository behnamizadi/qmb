<?php if(isset($ptitle)) echo $ptitle; ?>
<table class="create">
	<tr>
		<td>
			
			<img src="<?php $path=PHP40::get()->homeUrl;echo $path; ?>pics/<?php echo $picture; ?>" alt="عکس پرسنلی" width="100"  style="float:left" align="middle" style="display: inline" />
		</td>
	</tr>
</table>

<?php
if(isset($profile)):
?>
<h3>مشخصات فردی</h3>
<?php
echo $profile; 
endif;
?>
<?php
if(isset($spouse)):
?>
<h3>مشخصات همسر</h3>
<?php
echo $spouse; 
endif;
?>
<?php
if(isset($spouse)):
?>
<h3>مشخصات فرزندان</h3>
<?php
echo $childs; 
endif;
?>
<?php
if(isset($employment)):
?>
<h3>اطلاعات پایه‌ای شغل</h3>
<?php
echo $employment; 
endif;
?>
<?php
if(isset($education)):
?>
<h3>اطلاعات تحصیلی</h3>
<?php
echo $education; 
endif;
?>
<?php
if(isset($carrier)):
?>
<h3>مسیر شغلی</h3>
<?php
echo $carrier; 
endif;
?>
<h3>نمرات ارزشیابی</h3>
        <table class="table table-striped table-bordered">
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
<h3>سایر</h3>
<table class="table table-striped table-bordered">
	<tr>
		<th class="grid_th">تعداد تشویق</th>
		<th class="grid_th">تعداد تنبیه</th>
		<th class="grid_th">تعداد دوره های گذرانده</th>
	</tr>
	<tr>
		<td><?php echo $p1Count; ?></td>
		<td><?php echo $p2Count; ?></td>
		<td><?php echo $tCount; ?></td>
	</tr>
</table>      
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>
