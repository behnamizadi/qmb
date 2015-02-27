<?php
echo $grid;
echo '<br /><h4>خلاصه کل مرخصی‌ها در سال '.$y.':</h4>';
echo $detail;
if(isset($c_id)):
?>
<p>
<?php echo CUrl::createLink('افزودن مرخصی', 'vacation/add/'.$c_id, 'target="_blank" class="box"', $in = TRUE); ?>
<?php echo CUrl::createLink('نسخه چاپی', 'vacation/summprint/'.$c_id.'/'.$y, 'target="_blank" class="box"', $in = TRUE); ?>
</p>
<?php endif; ?>
