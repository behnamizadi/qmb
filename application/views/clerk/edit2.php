<p>
<?php
echo CUrl::createLink('ویرایش مشخصات فردی','profile/edit/'.$clerk_id,'class="box"');
echo CUrl::createLink('ویرایش افراد تحت تکفل','spouse/edit/'.$clerk_id,'class="box"');
echo CUrl::createLink('ویرایش اطلاعات پایه‌ای شغل','employment/edit/'.$clerk_id,'class="box"');
echo CUrl::createLink('ویرایش اطلاعات تحصیلی','education/edit/'.$clerk_id,'class="box"');
?>
</p>
<p>
<?php
echo CUrl::createLink('افزودن مشخصات فردی','profile/add/'.$clerk_id.'/'.$time_added,'class="box"');
echo CUrl::createLink('افزودن افراد تحت تکفل','spouse/add/'.$clerk_id.'/'.$time_added,'class="box"');
echo CUrl::createLink('افزودن اطلاعات پایه‌ای شغل','employment/add/'.$clerk_id.'/'.$time_added,'class="box"');
echo CUrl::createLink('افزودن اطلاعات تحصیلی','education/add/'.$clerk_id.'/'.$time_added,'class="box"');
?>
</p>