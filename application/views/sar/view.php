<?php if(isset($ptitle)) echo $ptitle; ?>
<h3>مشخصات شعبه:</h3>
<?php
echo $body;
?>
<div style="width: 40%">
	    <h3>تاریخچه درجات:</h3>
	    <?php
	        echo $degrees;
	    ?>
</div>
<?php
if(isset($link)) echo $link;
?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>