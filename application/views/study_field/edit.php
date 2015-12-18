<?php
echo $form;
if(! empty($study_degree))
    $url = 'manage/'.$study_degree;
else {
	$url = 'filter';
}
?>
<a href="<?php echo PHP40::get()->homeUrl;?>index.php/study_field/<?php echo $url; ?>" class="box">بازگشت</a></p>
</form>