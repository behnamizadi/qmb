<?php
$a = new Lookup;
$c = $a -> getAll('notice_post');
$d = new Branch;
$e = $d -> getByOstan();
$c['default'] = 'انتخاب';
$e = array('1' => 'سرپرستی') + $e;
return array('index' => array('<p><label for="clerk_number">شماره کارمندی<span class="error">*</span></label>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'decoration' => FALSE), 'search' => array('type' => 'button', 'value' => '...', 'decoration' => FALSE), '</p>', 'submit' => array('type' => 'submit', 'in' => 'class="btn btn-primary"', 'value' => 'مرحله بعد')), 'add,edit' => array('reference' => 'model', 'post' => array('type' => 'select', 'options' => $c, 'in' => 'class="select"', 'validation' => array('required')), 'place' => array('type' => 'select', 'options' => $e, 'in' => 'class="select"', 'validation' => 'required', ), '<p><label>تاریخ پایان<span class="error">*</span></label>', 'd_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'd'), 'm_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'm'), 'y_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1392_1395', 'validation' => 'required', 'showFieldErrorText' => FALSE, 'reference' => 'y'), '</p>', 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="box"')));
?>