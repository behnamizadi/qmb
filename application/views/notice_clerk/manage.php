<?php
$k = new CGrid;
$k -> values = $values;
$k -> headers = array('name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'),'clerk_number' => array('label' => 'کد پرسنلی') ,'post' => array('format' => 'model[Lookup,getById($value,notice_post)]', 'label' => 'پست سازمانی'), 'place' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => 'محل خدمت'), 'date_end' => array('format' => 'model[Cal,getDate($value)]'), );
$k -> operations['view'] = FALSE;
$k -> sort = 'date_end';
$k -> counter = TRUE;
$l = 'لیست اخطار قرارداد کارمند';
if ($isprint) {$k -> operations = FALSE;
    $k -> noSort = TRUE;
    $layout = 'print';
    $ptitle = '<h1>' . $l . '</h1>';
    $m = new User;
    $producer = $m -> producer();
    $k -> paginate = FALSE;
} else 
{
    $pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'notice_clerk/manage/print', 'class="box" target="_blank"') . '</p></center>';
}
$title = $l;
$grid = $k -> run();
echo $grid;    
?>