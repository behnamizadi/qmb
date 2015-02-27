<?php if(isset($ptitle)) echo $ptitle; ?>
<?php
if(isset($body))
	echo $body;
echo $grid;
?>
<?php if(! $print): ?>
	<p>
	<?php echo CUrl::createLink('ثبت تشویق', 'p_p/add/'.$c_id.'/1', 'target="_blank" class="box"', $in = TRUE);
	echo CUrl::createLink('ثبت تنبیه', 'p_p/add/'.$c_id.'/2', 'target="_blank" class="box"', $in = TRUE); ?>
	</p>
<?php endif; ?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>