<?php
return array('add' => array('<p><label for="clerk_number">کد پرسنلی<span class="error">*</span></label>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'decoration' => FALSE), '</p>', 'submit' => array('type' => 'submit', 'in' => 'class="btn btn-primary"', 'value' => 'مرحله بعد')), 
'edit' => array('<p><label for="clerk_number">کد پرسنلی<span class="error">*</span></label>', 'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'decoration' => FALSE), 'search' => array('type' => 'button', 'value' => '...', 'decoration' => FALSE), '</p>', 'submit' => array('type' => 'submit', 'in' => 'class="btn btn-default"', 'value' => 'مرحله بعد')));

