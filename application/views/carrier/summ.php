<?php if(isset($ptitle)) echo $ptitle; ?>
<?php
if(isset($body))
	echo $body;
echo $grid;
?>
<?php if(! $print): ?>
	<p>
	<?php echo CUrl::createLink('افزودن مسیر شغلی', 'carrier/add/'.$c_id, 'target="_blank" class="box"', $in = TRUE); ?>
	</p>
<?php endif; ?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>