<?php
return array('add' => array('code' => array('type' => 'text', 'in' => 'class="txt"', 'validation' => array('required,unique[tbl_notice_asr]', 'message' => array('unique' => 'برای این شعبه قبلا اخطار باجه عصر ثبت شده است.'))), '<p><label>تاریخ پایان<span class="error">*</span></label>', 'd_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => 'required', 'showFieldErrorText' => FALSE, ), 'm_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => 'required', 'showFieldErrorText' => FALSE, ), 'y_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1392_1395', 'validation' => 'required', 'showFieldErrorText' => FALSE, ), '</p>', 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="box"')), 'edit' => array('<p><label>تاریخ پایان<span class="error">*</span></label>', 'd_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'd'), 'm_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'm'), 'y_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1392_1395', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'y'), '</p>', 'submit' => array('type' => 'submit', 'value' => 'ویرایش', 'in' => 'class="box"')));
?>