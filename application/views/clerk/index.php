<?php
if(!empty($info)):
    ?>
    <div class="info"><?php echo $info; ?></div>
    <?php
endif;
    ?>
 <form class="form-horizontal" method="post" id="search_form">
<?php
include(APP_ROOT."views/layouts/search_box.php");
?><div class="form-group">
          <div class="col-md-3">
<input type="hidden" name="itisform" id="itisform" value="itisform" />              
        <input class="btn btn-success" type="submit" name="sumbit" id="submit" value="مرحله بعد" />
        </div>
 </div>
  </form>