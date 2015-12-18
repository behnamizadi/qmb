<?php
return array(
'add' => array( 
	'clerk_number' => array('type' => 'text', 'in' => ' maxLength="25"', 'validation' => array('required,number'), ), 
	'submit' => array('type' => 'submit', 'in' => 'class="btn btn-primary"', 'value' => 'مرحله بعد')), 
'edit' => array(
	'clerk_number' => array('type' => 'text', 'in' => ' maxLength="25"', 'validation' => array('required,number'), ), 
	'search' => array('type' => 'button', 'value' => '...', 'decoration' => FALSE), 
	'submit' => array('type' => 'submit', 'in' => 'class="btn btn-default"', 'value' => 'مرحله بعد'))
	);

