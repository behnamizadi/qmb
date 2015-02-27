<?php
for($i = 2;$i <= 7;$i++)
{
    $x['study_degree'.$i] = 'مقطع تحصیلی';
    $x['study_field'.$i] = 'رشته تحصیلی';
    $x['place'.$i] = 'محل تحصیل';
}
return array(
    'add'=>$x,
    'manage,edit'=>array(
        'study_degree'=>'مقطع تحصیلی',
        'study_field'=>'رشته تحصیلی',
        'place'=>'محل تحصیل',
        'date_get'=>'تاریخ اخذ مدرک'
    )
);
?>
