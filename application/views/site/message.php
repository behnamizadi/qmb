<?php if(isset($ptitle)) echo $ptitle; ?>
<?php
if(!empty($error)):
	?>
	<div class="red"><?php echo $error; ?></div>
<?php 
elseif(!empty($success)):
	?>
	<div class="success"><?php echo $success; ?></div>
<?php endif; ?>
<?php
if(!empty($body))
    echo $body;
if(!empty($detail))
    echo $detail;
if(!empty($grid))
    echo $grid;
if(!empty($form))
    echo $form;
if(!empty($info)):
    ?>
    <div class="info"><?php echo $info; ?></div>
<?php endif; ?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>
