<?php
$a = new Lookup;
$b = $a -> getAll('post');
$c = $a -> getAll('employment_status');
$d = $a -> getAll('job_status');
$e = $a -> getAll('hokm_type');
$c['default'] = $d['default'] = $e['default'] = $b['default'] = 'انتخاب';
return array('add' => array('<table class="create"><tr><td>', 'hesab' => array('type' => 'text', 'in' => 'class="txt" maxlength="25"', 'validation' => array('required,maxLength[25]'), ), '</td><td>', 'bon' => array('type' => 'text', 'in' => 'class="txt" maxlength="16"', 'validation' => array('required,length[16]'), ), '</td><td>', 'bimeh' => array('type' => 'text', 'in' => 'class="txt" maxlength="25"', 'validation' => array('required,maxLength[25]'), ), '</td></tr><tr><td>', '<label>تاریخ استخدام<span class="error">*</span></label>', 'd_employed' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 'm_employed' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 'y_employed' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => array('required'), ), '</td><td><label>عکس پرسنلی<span class="error">*</span></label>', 'picture' => array('type' => 'file', 'decoration' => FALSE, 'in' => 'size="4"', 'showFieldErrorText' => TRUE), '</td></tr></table>', 'submit' => array('type' => 'submit', 'value' => 'مرحله بعد', 'in' => 'class="btn btn-primary"')), 'edit' => array('reference' => 'model', '<table style="background-color: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 10px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    margin: 0 auto 20px;
    padding: 19px 29px 29px;
    width:90%; table-layout: fixed;"><tr><td>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="10"', 'validation' => array('required,number,maxLength[10]'), 'reference' => 'clerk_number', 'label' => 'کد پرسنلی'), '</td><td>', 'hesab' => array('type' => 'text', 'in' => 'class="txt" maxlength="25"', 'validation' => array('required,maxLength[25]'), ), '</td><td>', 'bon' => array('type' => 'text', 'in' => 'class="txt" maxlength="16"', 'validation' => array('required,length[16]'), ), '</td></tr><tr><td>', 'bimeh' => array('type' => 'text', 'in' => 'class="txt" maxlength="25"', 'validation' => array('required,maxLength[25]'), ), '</td><td>', '<label>تاریخ استخدام<span class="error">*</span></label>', 'd_employed' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), 'reference' => 'd'), 'm_employed' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'm'), 'y_employed' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => array('required'), 'reference' => 'y'), ));
?>
