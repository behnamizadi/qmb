<?php if(isset($ptitle)) echo $ptitle; ?>
<?php
echo $body;
?>
<?php
if(CUrl::segment(3) != 'print'): ?>
<p><a href="<?php echo PHP40::get()->homeUrl; ?>index.php/branch/add" class="box">افزودن شعبه</a></p>
<?php endif; ?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>