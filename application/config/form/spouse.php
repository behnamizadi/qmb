<?php
$a = new Lookup;
$b = new StudyField;
$c = $a -> getAll('study_degree');
$d = $b -> getByDegree('study_degree');
$c['default'] = 'انتخاب';
return array('index' => array('takafol' => array('type' => 'text', 'in' => 'class="txt" maxLength="2"', 'validation' => 'maxLength[2],required,number', 'label' => 'تعداد افراد تحت تکفل', ), 'submit' => array('type' => 'submit', 'value' => 'مرحله بعد', 'in' => 'class="btn btn-primary"'), ), 'add' => array('<h3>اطلاعات همسر</h3><table  class="create"><tr><td>', 'name' => array('type' => 'text', 'in' => 'class="txt" maxlength="30"', 'validation' => array('required,maxLength[30]'), ), '</td><td>', 'lastname' => array('type' => 'text', 'in' => 'class="txt" maxlength="50"', 'validation' => array('required,maxLength[50]'), ), '</td><td>', 'sh_sh' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'validation' => array('required,maxLength[10],number'), ), '</td><td>', 'code_melli' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'validation' => array('required,length[10],number'), ), '</td></tr><tr><td>', 'father' => array('type' => 'text', 'in' => 'class="txt" maxlength="30"', 'validation' => array('required,maxLength[30]'), ), '</td><td>', '<label>تاریخ تولد<span class="error">*</span></label>', 'd_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 'm_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 'y_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1330_1380', 'validation' => array('required'), ), '</td><td>', 'city_born' => array('type' => 'text', 'in' => 'class="txt" maxlength="30"', 'validation' => array('required,maxLength[30]'), ), '</td><td><label>تاریخ ازدواج<span class="error">*</span></label>', 'd_married' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 'm_married' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 'y_married' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1330_1393', 'validation' => array('required'), ), '</td></tr><tr><td>', 'study_degree' => array('type' => 'select', 'options' => $c, 'validation' => array('required'), ), '</td><td>', 'study_field' => array('type' => 'select', ), '</td><td>', 'job' => array('type' => 'text', 'in' => 'class="txt" maxlength="40"', 'validation' => array('required,maxLength[128]'), ), '</td></tr></table>', ), 
'edit' => array('reference' => 'model', 
'<h3>اطلاعات همسر</h3>',
'name' => array('type' => 'text', 'validation' => array('required,maxLength[30]'), ), 
'lastname' => array('type' => 'text', 'validation' => array('required,maxLength[50]'), ), 
'sh_sh' => array('type' => 'text', 'validation' => array('required,maxLength[10],number'), ),
'code_melli' => array('type' => 'text',  'validation' => array('required,length[10],number'), ), 
'father' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ), 
'<label>تاریخ تولد<span class="error">*</span></label>', 
    'd_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), 'reference' => 'db'), 
    'm_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'mb'), 
    'y_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => Utility::years(90,0), 'validation' => array('required'), 'reference' => 'yb'), 
    'city_born' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ), 
'<label>تاریخ ازدواج<span class="error">*</span></label>', 
    'd_married' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month',
    'validation' => array('required'), 'reference' => 'dm'),
    'm_married' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'mm'), 
    'y_married' => array('decoration' => FALSE, 'type' => 'select', 'options' => Utility::years(70,0), 'validation' => array('required'), 'reference' => 'ym'), 
 'study_degree' => array('type' => 'select', 'options' => $c, 'validation' => array('required'), ), 
 'study_field' => array('type' => 'select', 'reference' => 'study_field', 'options' => CView::getVar('sfs')), 
 'job' => array('type' => 'text', 'job' => array('required,maxLength[40]'), ), 
 '<label> </label>', 
 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'decoration' => FALSE, 'in' => 'class="btn btn-primary"'), 
 '<a class="btn btn-default" href="' . PHP40::get() -> homeUrl . 'index.php/child/manage/$clerk_id" >ویرایش اطلاعات فرزند(ان)</a>' => array('type' => 'extra', 'reference' => 'clerk_id')));
?>