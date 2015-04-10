<?php
return array(
'add' => array('code' => array('type' => 'text', 'validation' => array('required,unique[tbl_notice_asr]', 'message' => array('unique' => 'برای این شعبه قبلا اخطار باجه عصر ثبت شده است.'))), 
    '<label>تاریخ پایان<span class="error">*</span></label>', 
    'd_end' => array('decoration' => FALSE, 'type' => 'select', 
    'options' => 'days_of_month', 'validation' => 'required', 'showFieldErrorText' => FALSE, ), 
    'm_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => 'required','showFieldErrorText' => FALSE, ), 
    'y_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => 'required', 'showFieldErrorText' => FALSE, ), 
    'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="btn btn-primary"')), 
'edit' => array('<label>تاریخ پایان<span class="error">*</span></label>', 
    'd_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'd'), 
    'm_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'm'), 
    'y_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'y'), 
    'submit' => array('type' => 'submit', 'value' => 'ویرایش')));
?>