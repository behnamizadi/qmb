<div class="info">درصورتی که قبلا نمره ارزشیابی همکاری برای این سال ثبت شده باشد، از طریق این فرم به‌روزرسانی خواهد شد.</div>
<?php
$form = new CForm;
if(is_array($clerks)):
?>
	<p><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
<?php	
	foreach($clerks as $clerk):
?>
			<p>
				<label style="color:#333;float:right;font-size:15px;width:160px;" for="<?php echo $clerk->id; ?>"><?php echo $clerk->clerk_number; echo '- '; echo $clerk->name.' '.$clerk->lastname;; ?></label>
				<input type="text" class="txt" name="<?php echo $clerk->id; ?>" />
			</p>
<?php			
	endforeach;
	echo '<label>&nbsp;</label><input type="submit" value="ثبت" class="box" name="submit" /></form></p>';
endif;

