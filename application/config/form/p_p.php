<?php
return array('index' => array('<p><label for="clerk_number">شماره کارمندی<span class="error">*</span></label>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'decoration' => FALSE), 'search' => array('type' => 'button', 'value' => '...', 'decoration' => FALSE), '</p>', 'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'مرحله بعد')), 'index2' => array('year' => array('type' => 'select', 'options' => 'years_1386_1393', 'validation' => array('required'), 'label' => 'سال'), 'type' => array('type' => 'radio', 'value' => array(1 => 'تشویق', 2 => 'تنبیه'), 'validation' => array('required'), ), 'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'مرحله بعد')), 'add,edit' => array('reference' => 'model', '<table class="create"><tr><td>', 'title' => array('type' => 'text', 'in' => 'class="txt" maxLength="128"', 'validation' => 'required,maxLenght[128]'), '</td><td><label>تاریخ اجرا<span class="error">*</span></label>', 'd_add' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), 'reference' => 'ds'), 'm_add' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'ms'), 'y_add' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'validation' => array('required'), 'reference' => 'ys'), '</td><td>', 'set_by' => array('type' => 'text', 'in' => 'class="txt" maxLength="80"', 'validation' => 'required,maxLenght[80]'), '</td><td>', 'hokm_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => 'maxLenght[25]'), '</td></tr><tr><td colspan="2">', 'description' => array('type' => 'textarea', 'rows' => 6, 'cols' => 60, ), '</td></tr></table>', 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="box"')));
?>