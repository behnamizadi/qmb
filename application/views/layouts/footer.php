<div class="footer">
    <div class="row">
<?php
$name = new User;
$c = new CJcalendar;
$o = new Ostan;
$ostan='';
if (null!==$o->getName()) $ostan=$o->getName();
$username='';
if (null!==$name->getName()) $username=$name->getName();
?> <div class="col-md-1 pull-right ">
<button class="btn btn-default btn-xs"><?php echo $c->date("l"); ?><?php echo $c->date("Y/m/j"); ?></button>
</div>  
<div class="col-md-2 pull-right ">
<button class="btn btn-default btn-xs"><?php echo $ostan ?></button>
</div>
<div class="col-md-2 pull-right ">
<button class="btn btn-default btn-xs"><?php echo $username; ?></button>
</div>
<?php
$notice = new Notice;
echo '<div class="col-md-3 pull-left">';
if ($notice -> getAsr())
{
    
	echo CUrl::createLink('تمدید باجه عصر!', 'notice_asr/manage','class="btn btn-xs btn-danger"');
   
}
if ($notice -> getClerk())
{
 
	echo CUrl::createLink('تمدید قرارداد کارمند!', 'notice_clerk/manage','class="btn btn-xs btn-danger"');
    
}
echo '</div>';
?>   
</div>
</div>