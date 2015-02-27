<?php
echo $body;
?>
<p><a href="<?php echo PHP40::get()->homeUrl;?>index.php/study_field/add/<?php if(!empty($study_degree)) echo $study_degree; ?>" class="box">افزودن رشته تحصیلی</a></p>