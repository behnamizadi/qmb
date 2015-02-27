<?php if(isset($ptitle)) echo $ptitle; ?>
<h3>مشخصات شعبه:</h3>
<?php
echo $body;
?>
<div style="overflow: hidden">
    <div style="width: 40%;float: right">
    <h3>امکانات شعبه:</h3>
    <?php
    echo $props;
    ?>
    </div>
    <div style="width: 50%;float: left">
    <h3>تاریخچه درجات:</h3>
    <?php
        echo $degrees;
    ?>
    </div>
</div>
<?php
if(isset($link)) echo $link;
?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>