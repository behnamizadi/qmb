<?php if(isset($ptitle)) echo $ptitle; ?>
<?php
echo $grid;
?>
<?php if(! $print): ?>
<p>
<?php echo CUrl::createLink('افزودن دوره', 'training/add/'.$c_id, 'target="_blank" class="box"', $in = TRUE); ?>
</p>
<?php endif; ?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>