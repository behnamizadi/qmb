<?php
return array('index' => array('<p><label for="clerk_number">شماره کارمندی<span class="error">*</span></label>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="10"', 'validation' => array('required,number,maxLength[10]'), 'decoration' => FALSE), 'search' => array('type' => 'button', 'value' => '...', 'decoration' => FALSE), '</p>', 'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'ارسال')), 'add' => array('<p><label for="clerk_number">شماره کارمندی<span class="error">*</span></label>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'decoration' => FALSE), '</p>', 'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'مرحله بعد')), 'edit' => array('<p><label for="clerk_number">شماره کارمندی<span class="error">*</span></label>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'decoration' => FALSE), 'search' => array('type' => 'button', 'value' => '...', 'decoration' => FALSE), '</p>', 'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'مرحله بعد')));
