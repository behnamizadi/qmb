<?php
return array(
'index' => array(
    'clerk_number' => array('type' => 'text',  'validation' => array('required,number')), 
    'search' => array('type' => 'button', 'value' => '...',), 
    'submit' => array('type' => 'submit', 'value' => 'مرحله بعد')), 
'index2' => array(
    'year' => array('type' => 'select', 'options' => 'lastTenYears', 'validation' => array('required'), 
    'label' => 'سال'), 'type' => array('type' => 'radio', 'value' => array(1 => 'تشویق', 2 => 'تنبیه'), 'validation' => array('required'), ), 
    'submit' => array('type' => 'submit', 'value' => 'مرحله بعد')), 
    'add,edit' => array('reference' => 'model','title' => array('type' => 'text', 'validation' => 'required,maxLenght[128]'), '</td><td><label>تاریخ اجرا<span class="error">*</span></label>', 'd_add' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), 'reference' => 'ds'), 'm_add' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'ms'), 'y_add' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => array('required'), 'reference' => 'ys'), '</td><td>', 'set_by' => array('type' => 'text', 'in' => 'class="txt" maxLength="80"', 'validation' => 'required,maxLenght[80]'), '</td><td>', 'hokm_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => 'maxLenght[25]'), '</td></tr><tr><td colspan="2">', 'description' => array('type' => 'textarea', 'rows' => 6, 'cols' => 60, ), '</td></tr></table>', 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="box"')));
?>