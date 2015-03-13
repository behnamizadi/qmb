<div class="footer">
<?php
$name = new User;
$c = new CJcalendar;
$o = new Ostan;
?> 
<span style="padding-right:5px;"><?php echo $c->date("l"); ?></span>  
<span style="padding-right:5px;"><?php echo $c->date("Y/m/j"); ?></span>  
<span style="padding-right:45px;"><?php echo $o->getName(); ?></span>
<span style="padding-right:45px;"><?php echo $name->getName(); ?></span>
<?php
$notice = new Notice;
if ($notice -> getAsr())
{
	echo '<span class="welcom_notice" style="padding-right:45px;padding-left:15px;float:left">'; 
	echo CUrl::createLink('تمدید باجه عصر!', 'notice_asr/manage','class="welcom_notice"');
	echo '</span>';
}
	

if ($notice -> getClerk())
{
	echo '<span class="welcom_notice" style="padding-right:45px;padding-left:15px;float:left">'; 
	echo CUrl::createLink('تمدید قرارداد کارمند!', 'notice_clerk/manage','class="welcom_notice"');
	echo '</span>';
}
?>   
</div>
