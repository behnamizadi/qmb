<?php
echo $body;
if(isset($type) && isset($add)):
?>
<p>
    <a href="<?php echo PHP40::get()->homeUrl; ?>/index.php/lookup/add/<?php echo $type; ?>" class="btn btn-success"><?php echo $add; ?></a>
</p>
<?php endif; ?>