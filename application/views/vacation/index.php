<?php
echo $form;
if(!empty($info)):
    ?>
    <div class="info"><?php echo $info; ?></div>
<?php endif; 
include(APP_ROOT."views/layouts/search_box.php");
?>
